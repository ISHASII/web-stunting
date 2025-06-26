<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Measurement;
use App\Services\ZScoreService;
use Carbon\Carbon;

class PetugasController extends Controller
{
    protected $zScoreService;

    public function __construct(ZScoreService $zScoreService)
    {
        $this->zScoreService = $zScoreService;
    }

    public function dashboard()
    {
        $myMeasurements = Measurement::where('user_id', auth()->id())->count();
        $todayMeasurements = Measurement::where('user_id', auth()->id())
            ->whereDate('measurement_date', today())->count();

        return view('petugas.dashboard', compact('myMeasurements', 'todayMeasurements'));
    }

    public function createMeasurement()
    {
        return view('petugas.measurement.create');
    }

    public function storeMeasurement(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:16',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'height' => 'required|numeric|min:30|max:150',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $birthDate = Carbon::parse($request->birth_date);
        $ageMonths = $birthDate->diffInMonths(Carbon::now());

        if ($ageMonths > 60) {
            return back()->withErrors(['birth_date' => 'Anak harus berusia 0-60 bulan']);
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('children-photos', 'public');
        }

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
            $zScore = $this->zScoreService->calculateZScore($ageMonths, $request->gender, $request->height);
            $status = $this->zScoreService->getStatus($zScore);

            Measurement::create([
                'child_id' => $child->id,
                'user_id' => auth()->id(),
                'age_months' => $ageMonths,
                'height' => $request->height,
                'z_score' => $zScore,
                'status' => $status,
                'measurement_date' => now(),
            ]);

            return redirect()->route('petugas.measurement.history')->with('success', 'Pengukuran berhasil disimpan');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function measurementHistory()
    {
        $measurements = Measurement::with('child')
            ->where('user_id', auth()->id())
            ->orderBy('measurement_date', 'desc')
            ->paginate(15);

        return view('petugas.measurement.history', compact('measurements'));
    }
}
