<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Measurement;
use App\Services\ZScoreService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StuntingController extends Controller
{
    protected $zScoreService;

    public function __construct(ZScoreService $zScoreService)
    {
        $this->zScoreService = $zScoreService;
    }

    public function showForm()
    {
        return view('stunting.form');
    }

    public function check(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:16',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'height' => 'required|numeric|min:30|max:150',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Calculate age in months
        $birthDate = Carbon::parse($request->birth_date);
        $ageMonths = $birthDate->diffInMonths(Carbon::now());

        if ($ageMonths > 60) {
            return back()->withErrors(['birth_date' => 'Anak harus berusia 0-60 bulan']);
        }

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('children-photos', 'public');
        }

        // Find or create child
        $child = Child::updateOrCreate(
            ['nik' => $request->nik],
            [
                'name' => $request->name,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'photo' => $photoPath,
            ]
        );

        try {
            // Calculate Z-Score
            $zScore = $this->zScoreService->calculateZScore($ageMonths, $request->gender, $request->height);
            $status = $this->zScoreService->getStatus($zScore);

            // Create measurement record
            $measurement = Measurement::create([
                'child_id' => $child->id,
                'user_id' => auth()->id() ?? null,
                'age_months' => $ageMonths,
                'height' => $request->height,
                'z_score' => $zScore,
                'status' => $status,
                'measurement_date' => now(),
            ]);

            return redirect()->route('stunting.result', $child->id);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan dalam perhitungan: ' . $e->getMessage()]);
        }
    }

    public function result(Child $child)
    {
        $latestMeasurement = $child->measurements()->latest()->first();
        return view('public.result', compact('child', 'latestMeasurement'));
    }

    public function history($nik)
    {
        $child = Child::where('nik', $nik)->firstOrFail();
        $measurements = $child->measurements()->orderBy('measurement_date', 'desc')->get();

        return view('public.history', compact('child', 'measurements'));
    }
}
