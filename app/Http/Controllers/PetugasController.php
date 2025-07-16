<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Measurement;
use App\Services\ZScoreService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\MeasurementExport;

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
        Log::info('=== MULAI PROSES STORE MEASUREMENT ===');
        Log::info('Data request masuk:', $request->all());
        Log::info('User yang login:', ['user_id' => Auth::id(), 'user_name' => Auth::user()?->name]);

        // Enhanced validation with better error messages
        try {
            $validated = $request->validate([
                'nik' => 'nullable|string|digits:16',
                'name' => 'required|string|max:255',
                'gender' => 'required|in:L,P',
                'birth_date' => 'required|date|before:today',
                'height' => 'required|numeric|min:30|max:150',
                'weight' => 'required|numeric|min:1|max:50',
                'head_circumference' => 'nullable|numeric|min:25|max:70',
                'arm_circumference' => 'nullable|numeric|min:5|max:30',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ], [
                'nik.digits' => 'NIK harus terdiri dari tepat 16 digit angka.',
                'birth_date.before' => 'Tanggal lahir harus sebelum hari ini.',
                'height.min' => 'Tinggi badan minimal 30 cm.',
                'height.max' => 'Tinggi badan maksimal 150 cm.',
                'weight.required' => 'Berat badan wajib diisi.',
                'weight.min' => 'Berat badan minimal 1 kg.',
                'weight.max' => 'Berat badan maksimal 50 kg.',
                'head_circumference.min' => 'Lingkar kepala minimal 25 cm.',
                'head_circumference.max' => 'Lingkar kepala maksimal 70 cm.',
                'arm_circumference.min' => 'Lingkar lengan atas minimal 5 cm.',
                'arm_circumference.max' => 'Lingkar lengan atas maksimal 30 cm.',
            ]);

            Log::info('Validasi berhasil:', $validated);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validasi gagal:', $e->errors());
            throw $e;
        }

        // Use database transaction for data consistency
        DB::beginTransaction();
        Log::info('Database transaction dimulai');

        try {
            // Calculate age in months
            $birthDate = Carbon::parse($request->birth_date);
            $ageMonths = (int) $birthDate->diffInMonths(Carbon::now());

            Log::info('Perhitungan usia:', [
                'birth_date' => $request->birth_date,
                'parsed_date' => $birthDate->toDateString(),
                'current_date' => Carbon::now()->toDateString(),
                'age_months' => $ageMonths
            ]);

            // Validate age (0-60 months)
            if ($ageMonths > 60) {
                DB::rollBack();
                Log::warning('Usia terlalu tua:', ['age_months' => $ageMonths]);
                return back()->withErrors(['birth_date' => 'Anak harus berusia 0-60 bulan (maksimal 5 tahun).'])->withInput();
            }

            if ($ageMonths < 0) {
                DB::rollBack();
                Log::warning('Usia negatif:', ['age_months' => $ageMonths]);
                return back()->withErrors(['birth_date' => 'Tanggal lahir tidak valid.'])->withInput();
            }

            // Normalize input
            $gender = strtoupper(trim($request->gender));
            $height = (float) $request->height;
            $weight = (float) $request->weight;

            Log::info('Data dinormalisasi:', [
                'gender' => $gender,
                'height' => $height,
                'weight' => $weight,
                'age_months' => $ageMonths
            ]);

            // Handle photo upload
            $photoPath = null;
            if ($request->hasFile('photo')) {
                Log::info('File foto ditemukan, memulai upload...');
                $photoPath = $request->file('photo')->store('children-photos', 'public');
                Log::info('Photo uploaded:', ['path' => $photoPath]);
            } else {
                Log::info('Tidak ada file foto');
            }

            // Check if child already exists
            $existingChild = null;
            if ($request->nik) {
                $existingChild = Child::where('nik', $request->nik)->first();
            }
            
            Log::info('Cek anak existing:', [
                'nik' => $request->nik,
                'existing_found' => $existingChild ? true : false,
                'existing_id' => $existingChild?->id
            ]);

            // Create or update child record
            $childData = [
                'name' => $request->name,
                'gender' => $gender,
                'birth_date' => $request->birth_date,
                'photo' => $photoPath ?? ($existingChild?->photo),
            ];

            if ($request->nik) {
                $child = Child::updateOrCreate(
                    ['nik' => $request->nik],
                    $childData
                );
            } else {
                $child = Child::create($childData);
            }

            Log::info('Child record saved:', [
                'child_id' => $child->id,
                'nik' => $child->nik,
                'name' => $child->name,
                'gender' => $child->gender,
                'birth_date' => $child->birth_date,
                'photo' => $child->photo,
                'was_recently_created' => $child->wasRecentlyCreated
            ]);

            // Test database connection before Z-Score calculation
            Log::info('Test database query - child count:', ['count' => Child::count()]);

            // Calculate Z-Score
            Log::info('=== MULAI PERHITUNGAN Z-SCORE ===');
            Log::info('Parameter Z-Score:', [
                'age_months' => $ageMonths,
                'gender' => $gender,
                'height' => $height,
                'zscore_service_class' => get_class($this->zScoreService)
            ]);

            // Test if ZScoreService is working
            if (!$this->zScoreService) {
                throw new \Exception('ZScoreService tidak tersedia');
            }

            $zScore = $this->zScoreService->calculateZScore($ageMonths, $gender, $height);
            $status = $this->zScoreService->getStatus($zScore);

            Log::info('Z-Score calculation result:', [
                'z_score' => $zScore,
                'status' => $status,
                'z_score_type' => gettype($zScore),
                'status_type' => gettype($status)
            ]);

            // Get authenticated user ID
            $userId = Auth::id();
            if (!$userId) {
                DB::rollBack();
                Log::error('User ID tidak ditemukan saat menyimpan pengukuran.');
                return back()->withErrors(['error' => 'Pengguna belum login. Silakan login ulang.'])->withInput();
            }

            Log::info('User ID ditemukan:', ['user_id' => $userId]);

            // Create measurement record
            $measurementData = [
                'child_id' => $child->id,
                'user_id' => $userId,
                'age_months' => $ageMonths,
                'height' => $height,
                'weight' => $weight,
                'head_circumference' => $request->head_circumference,
                'arm_circumference' => $request->arm_circumference,
                'z_score' => $zScore,
                'status' => $status,
                'measurement_date' => now(),
            ];

            Log::info('=== MULAI SIMPAN MEASUREMENT ===');
            Log::info('Data measurement yang akan disimpan:', $measurementData);

            // Check if Measurement model is accessible
            Log::info('Test Measurement model - total count:', ['count' => Measurement::count()]);

            $measurement = Measurement::create($measurementData);

            Log::info('Measurement record created successfully:', [
                'measurement_id' => $measurement->id,
                'child_id' => $measurement->child_id,
                'user_id' => $measurement->user_id,
                'z_score' => $measurement->z_score,
                'status' => $measurement->status,
                'created_at' => $measurement->created_at
            ]);

            // Commit transaction
            DB::commit();
            Log::info('Database transaction berhasil di-commit');

            // Verify data was saved
            $savedMeasurement = Measurement::with('child')->find($measurement->id);
            if ($savedMeasurement) {
                Log::info('=== VERIFIKASI DATA TERSIMPAN ===');
                Log::info('Verification - measurement saved:', [
                    'id' => $savedMeasurement->id,
                    'child_name' => $savedMeasurement->child->name,
                    'status' => $savedMeasurement->status,
                    'height' => $savedMeasurement->height,
                    'z_score' => $savedMeasurement->z_score
                ]);
            } else {
                Log::error('VERIFIKASI GAGAL - Data tidak ditemukan setelah disimpan');
            }

            // Check total measurements in database
            $totalMeasurements = Measurement::count();
            Log::info('Total measurements in database after save:', ['total' => $totalMeasurements]);

            Log::info('=== PROSES SELESAI BERHASIL ===');

            return redirect()->route('petugas.measurement.history')
                ->with('success', 'Pengukuran berhasil disimpan dengan status: ' . $status);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('=== ERROR DALAM STORE MEASUREMENT ===');
            Log::error('Error details:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return with more specific error information
            $errorMessage = 'Terjadi kesalahan: ' . $e->getMessage();
            if (app()->environment('local')) {
                $errorMessage .= ' (File: ' . basename($e->getFile()) . ', Line: ' . $e->getLine() . ')';
            }

            return back()->withErrors(['error' => $errorMessage])->withInput();
        }
    }

    public function measurementHistory(Request $request)
    {
        $userId = Auth::id();

        // Start with base query
        $query = Measurement::with(['child' => function($query) {
                $query->select('id', 'nik', 'name', 'gender', 'birth_date');
            }])
            ->where('user_id', $userId);

        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('child', function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nik', 'like', '%' . $searchTerm . '%');
            });
        }

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Apply date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('measurement_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('measurement_date', '<=', $request->date_to);
        }

        // Apply gender filter (through child relationship)
        if ($request->filled('gender')) {
            $query->whereHas('child', function($q) use ($request) {
                $q->where('gender', $request->gender);
            });
        }

        // Apply age range filter
        if ($request->filled('age_from')) {
            $query->where('age_months', '>=', $request->age_from);
        }

        if ($request->filled('age_to')) {
            $query->where('age_months', '<=', $request->age_to);
        }

        // Apply height range filter
        if ($request->filled('height_from')) {
            $query->where('height', '>=', $request->height_from);
        }

        if ($request->filled('height_to')) {
            $query->where('height', '<=', $request->height_to);
        }

        // Apply sorting
        $sortBy = $request->get('sort_by', 'measurement_date');
        $sortOrder = $request->get('sort_order', 'desc');

        $allowedSortFields = ['measurement_date', 'status', 'height', 'age_months', 'z_score'];
        if (in_array($sortBy, $allowedSortFields)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('measurement_date', 'desc');
        }

        // Get paginated results
        $measurements = $query->paginate(15);

        // Get filter statistics for the current user
        $stats = $this->getMeasurementStats($userId, $request);

        Log::info('Filter applied to measurement history:', [
            'user_id' => $userId,
            'filters' => $request->only(['search', 'status', 'date_from', 'date_to', 'gender', 'age_from', 'age_to', 'height_from', 'height_to']),
            'total_results' => $measurements->total(),
            'current_page' => $measurements->currentPage()
        ]);

        return view('petugas.measurement.history', compact('measurements', 'stats'));
    }

    /**
     * Export measurement data to Excel
     */    public function exportExcel(Request $request)
    {
        try {
            $userId = Auth::id();
            $user = Auth::user();

            Log::info('Starting Excel export', [
                'user_id' => $userId,
                'filters' => $request->all()
            ]);

            // Build query with same filters as history
            $query = $this->buildFilteredQuery($userId, $request);

            // Get all filtered data (remove pagination for export)
            $measurements = $query->get();

            Log::info('Export Excel data loaded:', [
                'user_id' => $userId,
                'filters' => $request->only(['search', 'status', 'date_from', 'date_to', 'gender', 'age_from', 'age_to', 'height_from', 'height_to']),
                'total_records' => $measurements->count()
            ]);

            // Check if we have data
            if ($measurements->isEmpty()) {
                Log::warning('No data found for export');
                return back()->with('warning', 'Tidak ada data untuk diekspor dengan filter yang dipilih.');
            }

            // Create spreadsheet directly using PhpSpreadsheet
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Data Pengukuran');

            // Set headers
            $headers = [
                'A1' => 'No',
                'B1' => 'Tanggal Pengukuran',
                'C1' => 'NIK',
                'D1' => 'Nama Anak',
                'E1' => 'Jenis Kelamin',
                'F1' => 'Tanggal Lahir',
                'G1' => 'Usia (Bulan)',
                'H1' => 'Tinggi Badan (cm)',
                'I1' => 'Z-Score',
                'J1' => 'Status Stunting',
                'K1' => 'Petugas'
            ];

            foreach ($headers as $cell => $value) {
                $sheet->setCellValue($cell, $value);
            }

            // Style headers
            $headerStyle = [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => '3B82F6']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC']
                    ]
                ]
            ];
            $sheet->getStyle('A1:K1')->applyFromArray($headerStyle);

            // Add data rows
            $row = 2;
            foreach ($measurements as $index => $measurement) {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, Carbon::parse($measurement->measurement_date)->format('d/m/Y'));
                $sheet->setCellValue('C' . $row, $measurement->child->nik ?? 'N/A');
                $sheet->setCellValue('D' . $row, $measurement->child->name ?? 'N/A');
                $sheet->setCellValue('E' . $row, $measurement->child->gender == 'L' ? 'Laki-laki' : 'Perempuan');
                $sheet->setCellValue('F' . $row, Carbon::parse($measurement->child->birth_date)->format('d/m/Y'));
                $sheet->setCellValue('G' . $row, $measurement->age_months);
                $sheet->setCellValue('H' . $row, $measurement->height);
                $sheet->setCellValue('I' . $row, number_format((float)$measurement->z_score, 2));
                $sheet->setCellValue('J' . $row, $measurement->status);
                $sheet->setCellValue('K' . $row, $measurement->user->name ?? 'N/A');
                $row++;
            }

            // Style data cells
            $dataRange = 'A2:K' . ($row - 1);
            $dataStyle = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC']
                    ]
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ]
            ];
            $sheet->getStyle($dataRange)->applyFromArray($dataStyle);

            // Auto-size columns
            foreach (range('A', 'K') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            // Create filename with current date and filters
            $filename = 'data-pengukuran-' . str_replace(' ', '-', $user->name) . '-' . Carbon::now()->format('Y-m-d-H-i-s') . '.xlsx';

            // Add filter info to filename if filters are applied
            if ($request->hasAny(['search', 'status', 'date_from', 'date_to', 'gender'])) {
                $filename = 'data-pengukuran-filtered-' . str_replace(' ', '-', $user->name) . '-' . Carbon::now()->format('Y-m-d-H-i-s') . '.xlsx';
            }

            Log::info('Creating Excel file', [
                'filename' => $filename,
                'measurements_count' => $measurements->count(),
                'rows_created' => $row - 1
            ]);

            // Create writer and save to temp file
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $tempFile = storage_path('app/exports/' . $filename);

            // Ensure exports directory exists
            if (!file_exists(dirname($tempFile))) {
                mkdir(dirname($tempFile), 0755, true);
            }

            $writer->save($tempFile);

            Log::info('Excel file created successfully', [
                'file_path' => $tempFile,
                'file_size' => file_exists($tempFile) ? filesize($tempFile) : 0
            ]);

            // Return download response
            return response()->download($tempFile, $filename)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('Excel export failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal mengexport data: ' . $e->getMessage());
        }
    }

    /**
     * Export measurement data to PDF
     */
    public function exportPdf(Request $request)
    {
        $userId = Auth::id();
        $user = Auth::user();

        // Build query with same filters as history
        $query = $this->buildFilteredQuery($userId, $request);

        // Get all filtered data (remove pagination for export)
        $measurements = $query->get();

        Log::info('Export PDF requested:', [
            'user_id' => $userId,
            'filters' => $request->only(['search', 'status', 'date_from', 'date_to', 'gender', 'age_from', 'age_to', 'height_from', 'height_to']),
            'total_records' => $measurements->count()
        ]);

        // Get filter information for display
        $filterInfo = $this->getFilterInfo($request);

        $data = [
            'measurements' => $measurements,
            'user' => $user,
            'export_date' => Carbon::now(),
            'filter_info' => $filterInfo,
            'stats' => $this->getMeasurementStats($userId, $request)
        ];

        $pdf = Pdf::loadView('exports.measurements-pdf', $data)
                  ->setPaper('a4', 'landscape')
                  ->setOptions([
                      'defaultFont' => 'DejaVu Sans',
                      'isHtml5ParserEnabled' => true,
                      'isRemoteEnabled' => true,
                  ]);

        // Create filename
        $filename = 'laporan-pengukuran-' . $user->name . '-' . Carbon::now()->format('Y-m-d-H-i-s') . '.pdf';

        if ($request->hasAny(['search', 'status', 'date_from', 'date_to', 'gender'])) {
            $filename = 'laporan-pengukuran-filtered-' . $user->name . '-' . Carbon::now()->format('Y-m-d-H-i-s') . '.pdf';
        }

        return $pdf->download($filename);
    }

    /**
     * Build filtered query for exports (reusable method)
     */
    private function buildFilteredQuery($userId, Request $request)
    {
        $query = Measurement::with([
                'child' => function($query) {
                    $query->select('id', 'nik', 'name', 'gender', 'birth_date');
                },
                'user' => function($query) {
                    $query->select('id', 'name');
                }
            ])
            ->where('user_id', $userId);

        // Apply same filters as measurementHistory
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('child', function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nik', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('measurement_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('measurement_date', '<=', $request->date_to);
        }

        if ($request->filled('gender')) {
            $query->whereHas('child', function($q) use ($request) {
                $q->where('gender', $request->gender);
            });
        }

        if ($request->filled('age_from')) {
            $query->where('age_months', '>=', $request->age_from);
        }

        if ($request->filled('age_to')) {
            $query->where('age_months', '<=', $request->age_to);
        }

        if ($request->filled('height_from')) {
            $query->where('height', '>=', $request->height_from);
        }

        if ($request->filled('height_to')) {
            $query->where('height', '<=', $request->height_to);
        }

        // Apply default sorting
        $query->orderBy('measurement_date', 'desc');

        return $query;
    }

    /**
     * Get filter information for display in exports
     */
    private function getFilterInfo(Request $request)
    {
        $filters = [];

        if ($request->filled('search')) {
            $filters[] = 'Pencarian: ' . $request->search;
        }

        if ($request->filled('status')) {
            $filters[] = 'Status: ' . $request->status;
        }

        if ($request->filled('date_from')) {
            $filters[] = 'Dari Tanggal: ' . Carbon::parse($request->date_from)->format('d/m/Y');
        }

        if ($request->filled('date_to')) {
            $filters[] = 'Sampai Tanggal: ' . Carbon::parse($request->date_to)->format('d/m/Y');
        }

        if ($request->filled('gender')) {
            $genderText = $request->gender == 'L' ? 'Laki-laki' : 'Perempuan';
            $filters[] = 'Jenis Kelamin: ' . $genderText;
        }

        if ($request->filled('age_from')) {
            $filters[] = 'Usia Minimal: ' . $request->age_from . ' bulan';
        }

        if ($request->filled('age_to')) {
            $filters[] = 'Usia Maksimal: ' . $request->age_to . ' bulan';
        }

        if ($request->filled('height_from')) {
            $filters[] = 'Tinggi Minimal: ' . $request->height_from . ' cm';
        }

        if ($request->filled('height_to')) {
            $filters[] = 'Tinggi Maksimal: ' . $request->height_to . ' cm';
        }

        return $filters;
    }

    /**
     * Get measurement statistics for current user with filters applied
     */
    private function getMeasurementStats($userId, Request $request)
    {
        $baseQuery = Measurement::where('user_id', $userId);

        // Apply same filters as main query for consistent stats
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $baseQuery->whereHas('child', function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nik', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('date_from')) {
            $baseQuery->whereDate('measurement_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $baseQuery->whereDate('measurement_date', '<=', $request->date_to);
        }

        if ($request->filled('gender')) {
            $baseQuery->whereHas('child', function($q) use ($request) {
                $q->where('gender', $request->gender);
            });
        }

        if ($request->filled('age_from')) {
            $baseQuery->where('age_months', '>=', $request->age_from);
        }

        if ($request->filled('age_to')) {
            $baseQuery->where('age_months', '<=', $request->age_to);
        }

        if ($request->filled('height_from')) {
            $baseQuery->where('height', '>=', $request->height_from);
        }

        if ($request->filled('height_to')) {
            $baseQuery->where('height', '<=', $request->height_to);
        }

        // Get status counts
        $statusCounts = [
            'total' => $baseQuery->count(),
            'normal' => (clone $baseQuery)->where('status', 'Normal')->count(),
            'pendek' => (clone $baseQuery)->where('status', 'Pendek')->count(),
            'sangat_pendek' => (clone $baseQuery)->where('status', 'Sangat Pendek')->count(),
            'tinggi' => (clone $baseQuery)->where('status', 'Tinggi')->count(),
        ];

        return $statusCounts;
    }

    // ... rest of your existing methods (index, create, store, edit, update, destroy)

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
