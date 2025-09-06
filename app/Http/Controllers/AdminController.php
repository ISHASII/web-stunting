<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Measurement;
use App\Models\User;
use App\Models\Puskesmas;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ChildrenExport;
use App\Exports\SingleChildExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalChildren = Child::count();
        $totalMeasurements = Measurement::count();
        $totalPetugas = User::where('role', 'petugas')->count();
        $stuntedChildren = Measurement::whereIn('status', ['Sangat Pendek', 'Pendek'])->count();

        // Additional dashboard statistics
        $recentMeasurements = Measurement::with(['child', 'user'])
            ->orderBy('measurement_date', 'desc')
            ->take(5)
            ->get();

    // Use a DB-driver-specific month extractor because SQLite doesn't support MONTH()
    $driver = DB::getPdo()->getAttribute(\PDO::ATTR_DRIVER_NAME);
    $monthExpr = $driver === 'sqlite' ? "strftime('%m', measurement_date)" : 'MONTH(measurement_date)';

    $monthlyStats = Measurement::selectRaw("
        {$monthExpr} as month,
        COUNT(*) as total,
        SUM(CASE WHEN status = 'Normal' THEN 1 ELSE 0 END) as normal,
        SUM(CASE WHEN status = 'Pendek' THEN 1 ELSE 0 END) as pendek,
        SUM(CASE WHEN status = 'Sangat Pendek' THEN 1 ELSE 0 END) as sangat_pendek
        ")
        ->whereYear('measurement_date', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        return view('admin.dashboard', compact(
            'totalChildren',
            'totalMeasurements',
            'totalPetugas',
            'stuntedChildren',
            'recentMeasurements',
            'monthlyStats'
        ));
    }

    public function children(Request $request)
    {
        $query = Child::with(['latest_measurement', 'measurements']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Date range filters using date chooser
        $filterType = $request->get('filter_type', 'created_at'); // Default to created_at

        if ($request->filled('date_from')) {
            $query->whereDate($filterType, '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate($filterType, '<=', $request->date_to);
        }

        // Gender filter
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Status filter - Updated to include new status options
        if ($request->filled('status_filter')) {
            if ($request->status_filter == 'Belum Diukur') {
                $query->whereDoesntHave('measurements');
            } else {
                $query->whereHas('latest_measurement', function($q) use ($request) {
                    $q->where('status', $request->status_filter);
                });
            }
        }

        // Get paginated results
        $children = $query->orderBy('created_at', 'desc')->paginate(15);

        // Calculate stats for all children (not filtered) for stat cards
        $allChildren = Child::with('latest_measurement')->get();

        $normalCount = $allChildren->filter(function($child) {
            return $child->latest_measurement && $child->latest_measurement->status == 'Normal';
        })->count();

        $pendekCount = $allChildren->filter(function($child) {
            return $child->latest_measurement && $child->latest_measurement->status == 'Pendek';
        })->count();

        $sangatPendekCount = $allChildren->filter(function($child) {
            return $child->latest_measurement && $child->latest_measurement->status == 'Sangat Pendek';
        })->count();

        // Add new status count for "Tinggi"
        $tinggiCount = $allChildren->filter(function($child) {
            return $child->latest_measurement && $child->latest_measurement->status == 'Tinggi';
        })->count();

        $belumDiukurCount = $allChildren->filter(function($child) {
            return !$child->latest_measurement;
        })->count();

        return view('admin.children.index', compact(
            'children',
            'normalCount',
            'pendekCount',
            'sangatPendekCount',
            'tinggiCount',
            'belumDiukurCount'
        ));
    }

    public function showChild(Child $child)
    {
        $measurements = $child->measurements()->orderBy('measurement_date', 'desc')->get();

        // Growth chart data
        $chartData = $child->measurements()
            ->orderBy('measurement_date', 'asc')
            ->get()
            ->map(function($measurement) {
                return [
                    'date' => $measurement->measurement_date->format('Y-m-d'),
                    'height' => $measurement->height,
                    'weight' => $measurement->weight,
                    'age_months' => $measurement->age_months,
                    'status' => $measurement->status
                ];
            });

        return view('admin.children.show', compact('child', 'measurements', 'chartData'));
    }

    public function measurements(Request $request)
    {
        $query = Measurement::with(['child', 'user']);

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Date range filters using date chooser
        if ($request->filled('date_from')) {
            $query->whereDate('measurement_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('measurement_date', '<=', $request->date_to);
        }

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('child', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Petugas filter
        if ($request->filled('petugas_id')) {
            $query->where('user_id', $request->petugas_id);
        }

        $measurements = $query->orderBy('measurement_date', 'desc')->paginate(15);

        // Get petugas for filter
        $petugasList = User::where('role', 'petugas')
            ->orderBy('name')
            ->get();

        return view('admin.measurements.index', compact(
            'measurements',
            'petugasList'
        ));
    }

    public function petugas(Request $request)
    {
        $query = User::where('role', 'petugas')->withCount('measurements');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Date range filters for registration using date chooser
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $petugas = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.petugas.index', compact('petugas'));
    }

    public function createPetugas()
    {
        return view('admin.petugas.create');
    }

    public function storePetugas(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'petugas',
        ]);

        return redirect()->route('admin.petugas')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function editChild(Child $child)
    {
        return view('admin.children.edit', compact('child'));
    }

    public function updateChild(Request $request, Child $child)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:children,nik,' . $child->id,
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date|before:today',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $data = $request->except(['photo']);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($child->photo) {
                Storage::delete($child->photo);
            }

            $photoPath = $request->file('photo')->store('children-photos', 'public');
            $data['photo'] = $photoPath;
        }

        $child->update($data);

        return redirect()->route('admin.children.show', $child)
            ->with('success', 'Data anak berhasil diperbarui');
    }


    public function destroyChild(Child $child)
    {
        try {
            // Hapus foto jika ada
            if ($child->photo) {
                Storage::delete($child->photo);
            }

            // Hapus pengukuran terkait terlebih dahulu
            $child->measurements()->delete();

            // Hapus data anak
            $child->delete();

            return redirect()->route('admin.children')
                ->with('success', 'Data anak berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data anak: ' . $e->getMessage());
        }
    }

    public function editPetugas(User $user)
    {
        return view('admin.petugas.edit', compact('user'));
    }

    public function updatePetugas(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.petugas')->with('success', 'Petugas berhasil diupdate');
    }

    public function destroyPetugas(User $user)
    {
        // Validate if petugas has any measurements
        $measurementCount = $user->measurements()->count();

        if ($measurementCount > 0) {
            return redirect()->route('admin.petugas')
                ->with('error', "Tidak dapat menghapus petugas {$user->name} karena masih memiliki {$measurementCount} data pengukuran. Hapus data pengukuran terlebih dahulu.");
        }

        // Check if this is the last admin/superadmin user
        if (in_array($user->role, ['admin', 'superadmin'])) {
            $adminCount = User::whereIn('role', ['admin', 'superadmin'])->count();
            if ($adminCount <= 1) {
                return redirect()->route('admin.petugas')
                    ->with('error', 'Tidak dapat menghapus admin terakhir dalam sistem.');
            }
        }

        // Additional validation: prevent deleting currently logged in user
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.petugas')
                ->with('error', 'Tidak dapat menghapus akun yang sedang digunakan.');
        }

        try {
            $userName = $user->name;
            $user->delete();

            return redirect()->route('admin.petugas')
                ->with('success', "Petugas {$userName} berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->route('admin.petugas')
                ->with('error', 'Terjadi kesalahan saat menghapus data petugas. Silakan coba lagi.');
        }
    }

    public function puskesmas()
    {
        $puskesmas = Puskesmas::first();
        return view('admin.puskesmas.edit', compact('puskesmas'));
    }

    public function updatePuskesmas(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'schedule' => 'required|string',
            'head_name' => 'nullable|string|max:255',
            'website' => 'nullable|url',
        ]);

        $puskesmas = Puskesmas::first();

        if ($puskesmas) {
            $puskesmas->update($request->all());
        } else {
            Puskesmas::create($request->all());
        }

        return redirect()->route('admin.puskesmas')->with('success', 'Profil Puskesmas berhasil diupdate');
    }

    public function export(Request $request)
    {
        // Apply same filters as in children method
        $query = Child::with(['latest_measurement', 'measurements']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Date range filters
        $filterType = $request->get('filter_type', 'created_at');

        if ($request->filled('date_from')) {
            $query->whereDate($filterType, '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate($filterType, '<=', $request->date_to);
        }

        // Gender filter
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Status filter
        if ($request->filled('status_filter')) {
            if ($request->status_filter == 'Belum Diukur') {
                $query->whereDoesntHave('measurements');
            } else {
                $query->whereHas('latest_measurement', function($q) use ($request) {
                    $q->where('status', $request->status_filter);
                });
            }
        }

        $children = $query->orderBy('created_at', 'desc')->get();

        // Generate filename with filters
        $filename = 'data-anak';
        if ($request->filled('status_filter')) {
            $filename .= '-' . strtolower(str_replace(' ', '-', $request->status_filter));
        }
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $filename .= '-' . $request->date_from . '-to-' . $request->date_to;
        }
        $filename .= '-' . date('Y-m-d');

        if ($request->get('format') === 'pdf') {
            $pdf = Pdf::loadView('admin.exports.children_pdf', compact('children', 'request'));
            return $pdf->download("{$filename}.pdf");
        }

        // Default: Excel
        return Excel::download(new ChildrenExport($children), "{$filename}.xlsx");
    }

    public function exportChild(Child $child, Request $request)
    {
        $format = $request->get('format', 'excel');
        $filename = "data-anak-" . str_replace(' ', '-', strtolower($child->name)) . '-' . date('Y-m-d');

        if ($format === 'pdf') {
            return Excel::download(new SingleChildExport($child), "{$filename}.pdf", \Maatwebsite\Excel\Excel::DOMPDF);
        }

        return Excel::download(new SingleChildExport($child), "{$filename}.xlsx");
    }

    public function exportMeasurements(Request $request)
    {
        // Apply same filters as in measurements method
        $query = Measurement::with(['child', 'user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('measurement_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('measurement_date', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('child', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        if ($request->filled('petugas_id')) {
            $query->where('user_id', $request->petugas_id);
        }

        $measurements = $query->orderBy('measurement_date', 'desc')->get();

        $filename = 'data-pengukuran-' . date('Y-m-d');

        if ($request->get('format') === 'pdf') {
            $pdf = Pdf::loadView('admin.exports.measurements_pdf', compact('measurements', 'request'));
            return $pdf->download("{$filename}.pdf");
        }

        // For Excel export, you'll need to create MeasurementsExport class
        // return Excel::download(new MeasurementsExport($measurements), "{$filename}.xlsx");

        // Temporary fallback - you should create the MeasurementsExport class
        return response()->json(['message' => 'Excel export for measurements coming soon']);
    }

    public function reports(Request $request)
    {
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        // Base query with date range if provided
        $baseQuery = Measurement::query();

        if ($dateFrom) {
            $baseQuery->whereDate('measurement_date', '>=', $dateFrom);
        }

        if ($dateTo) {
            $baseQuery->whereDate('measurement_date', '<=', $dateTo);
        }

        // Monthly statistics
        $monthlyStats = (clone $baseQuery)->selectRaw('
                MONTH(measurement_date) as month,
                YEAR(measurement_date) as year,
                COUNT(*) as total,
                SUM(CASE WHEN status = "Normal" THEN 1 ELSE 0 END) as normal,
                SUM(CASE WHEN status = "Pendek" THEN 1 ELSE 0 END) as pendek,
                SUM(CASE WHEN status = "Sangat Pendek" THEN 1 ELSE 0 END) as sangat_pendek
            ')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Age group statistics
        $ageGroupStats = (clone $baseQuery)->selectRaw('
                CASE
                    WHEN age_months < 12 THEN "0-11 bulan"
                    WHEN age_months < 24 THEN "12-23 bulan"
                    WHEN age_months < 36 THEN "24-35 bulan"
                    WHEN age_months < 48 THEN "36-47 bulan"
                    ELSE "48+ bulan"
                END as age_group,
                COUNT(*) as total,
                SUM(CASE WHEN status = "Normal" THEN 1 ELSE 0 END) as normal,
                SUM(CASE WHEN status = "Pendek" THEN 1 ELSE 0 END) as pendek,
                SUM(CASE WHEN status = "Sangat Pendek" THEN 1 ELSE 0 END) as sangat_pendek
            ')
            ->groupBy('age_group')
            ->get();

        // Gender statistics
        $genderStats = (clone $baseQuery)->selectRaw('
                children.gender,
                COUNT(*) as total,
                SUM(CASE WHEN measurements.status = "Normal" THEN 1 ELSE 0 END) as normal,
                SUM(CASE WHEN measurements.status = "Pendek" THEN 1 ELSE 0 END) as pendek,
                SUM(CASE WHEN measurements.status = "Sangat Pendek" THEN 1 ELSE 0 END) as sangat_pendek
            ')
            ->join('children', 'measurements.child_id', '=', 'children.id')
            ->groupBy('children.gender')
            ->get();

        return view('admin.reports.index', compact(
            'monthlyStats',
            'ageGroupStats',
            'genderStats',
            'dateFrom',
            'dateTo'
        ));
    }
}
