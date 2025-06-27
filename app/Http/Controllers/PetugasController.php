<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Measurement;
use App\Services\ZScoreService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // Import Log Facade
use App\Models\User;

class PetugasController extends Controller
{
    protected $zScoreService;

    public function __construct(ZScoreService $zScoreService)
    {
        $this->zScoreService = $zScoreService;
    }

    public function dashboard()
    {
        $userId = Auth::id();

        $myMeasurements = Measurement::where('user_id', $userId)->count();
        $todayMeasurements = Measurement::where('user_id', $userId)
            ->whereDate('measurement_date', today())->count();

        return view('petugas.dashboard', compact('myMeasurements', 'todayMeasurements'));
    }

    public function createMeasurement()
    {
        Log::info('Form pengukuran dibuka');
        return view('petugas.measurement.create');
    }

    public function storeMeasurement(Request $request)
    {
        Log::info('Masuk ke storeMeasurement', $request->all());

        $request->validate([
            'nik' => 'required|string|max:16',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'height' => 'required|numeric|min:30|max:150',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // === PERBAIKAN 1: Normalisasi Input & Perhitungan Usia ===
        // Memastikan usia dihitung sebagai integer (pembulatan ke bawah)
        $birthDate = Carbon::parse($request->birth_date);
        $ageMonths = (int) $birthDate->diffInMonths(Carbon::now());

        // Memastikan gender dalam format yang benar (meski sudah ada validasi)
        $gender = strtoupper(trim($request->gender));
        $height = $request->height;

        if ($ageMonths > 60) {
            return back()->withErrors(['birth_date' => 'Anak harus berusia 0-60 bulan'])->withInput();
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('children-photos', 'public');
        }

        $child = Child::updateOrCreate(
            ['nik' => $request->nik],
            [
                'name' => $request->name,
                'gender' => $gender, // Menggunakan variabel gender yang sudah bersih
                'birth_date' => $request->birth_date,
                // Hanya update foto jika ada foto baru
                'photo' => $photoPath ?? Child::where('nik', $request->nik)->first()?->photo,
            ]
        );

        try {
            // === PERBAIKAN 2 (UTAMA): Panggil service dengan data yang benar ===
            // Hapus konversi ke 'male'/'female'. Langsung gunakan 'L'/'P'.
            $zScore = $this->zScoreService->calculateZScore($ageMonths, $gender, $height);
            $status = $this->zScoreService->getStatus($zScore);

            $userId = Auth::id();

            if (!$userId) {
                Log::error('User ID tidak ditemukan saat menyimpan pengukuran.');
                return back()->withErrors(['error' => 'Pengguna belum login. Silakan login ulang.'])->withInput();
            }

            $measurement = Measurement::create([
                'child_id' => $child->id,
                'user_id' => $userId,
                'age_months' => $ageMonths,
                'height' => $height,
                'z_score' => $zScore,
                'status' => $status,
                'measurement_date' => now(),
            ]);

            Log::info('Pengukuran berhasil disimpan', $measurement->toArray());

            return redirect()->route('petugas.measurement.history')->with('success', 'Pengukuran berhasil disimpan.');

        } catch (\Exception $e) {
            Log::error('Gagal menghitung Z-Score atau menyimpan pengukuran:', ['message' => $e->getMessage()]);
            // Mengembalikan input agar user tidak perlu mengisi ulang form
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function measurementHistory()
    {
        $userId = Auth::id();

        $measurements = Measurement::with('child')
            ->where('user_id', $userId)
            ->orderBy('measurement_date', 'desc')
            ->paginate(15);

        return view('petugas.measurement.history', compact('measurements'));
    }

    public function index()
    {
        $petugas = User::where('role', 'petugas')
            ->withCount('measurements')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'petugas',
        ]);

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit(User $petugas)
    {
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, User $petugas)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $petugas->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $petugas->update($data);

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil diupdate');
    }

    public function destroy(User $petugas)
    {
        $petugas->delete();

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil dihapus');
    }
}
