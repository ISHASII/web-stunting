{{-- filepath: c:\Users\ilham\Documents\deteksi-stunting\resources\views\exports\measurements-pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Pengukuran Stunting</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #3B82F6;
            padding-bottom: 15px;
        }

        .header h1 {
            color: #1E40AF;
            font-size: 18px;
            margin: 0 0 5px 0;
        }

        .header h2 {
            color: #3B82F6;
            font-size: 14px;
            margin: 0;
        }

        .info-section {
            margin-bottom: 20px;
            background-color: #F8FAFC;
            padding: 10px;
            border-radius: 5px;
        }

        .info-row {
            display: inline-block;
            width: 48%;
            margin-bottom: 5px;
        }

        .filter-section {
            margin-bottom: 20px;
            background-color: #EFF6FF;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #3B82F6;
        }

        .filter-title {
            font-weight: bold;
            color: #1E40AF;
            margin-bottom: 5px;
        }

        .stats-section {
            margin-bottom: 20px;
            background-color: #F0FDF4;
            padding: 10px;
            border-radius: 5px;
        }

        .stats-grid {
            display: table;
            width: 100%;
        }

        .stats-item {
            display: table-cell;
            text-align: center;
            padding: 5px;
            border-right: 1px solid #D1D5DB;
        }

        .stats-item:last-child {
            border-right: none;
        }

        .stats-number {
            font-size: 16px;
            font-weight: bold;
            color: #059669;
        }

        .stats-label {
            font-size: 9px;
            color: #6B7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #3B82F6;
            color: white;
            padding: 8px 4px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #2563EB;
            font-size: 9px;
        }

        td {
            padding: 6px 4px;
            border: 1px solid #D1D5DB;
            text-align: center;
            font-size: 8px;
        }

        .text-left {
            text-align: left;
        }

        .status-normal {
            background-color: #D1FAE5;
            color: #065F46;
            font-weight: bold;
        }

        .status-pendek {
            background-color: #FED7AA;
            color: #9A3412;
            font-weight: bold;
        }

        .status-sangat-pendek {
            background-color: #FECACA;
            color: #991B1B;
            font-weight: bold;
        }

        .status-tinggi {
            background-color: #E0E7FF;
            color: #3730A3;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            border-top: 1px solid #D1D5DB;
            padding-top: 15px;
            text-align: right;
            font-size: 9px;
            color: #6B7280;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA PENGUKURAN STUNTING</h1>
        <h2>Sistem Deteksi Stunting pada Anak</h2>
    </div>

    <div class="info-section">
        <div class="info-row">
            <strong>Petugas:</strong> {{ $user->name }}
        </div>
        <div class="info-row">
            <strong>Tanggal Cetak:</strong> {{ $export_date->format('d/m/Y H:i:s') }}
        </div>
        <div class="info-row">
            <strong>Total Data:</strong> {{ $measurements->count() }} pengukuran
        </div>
        <div class="info-row">
            <strong>Email:</strong> {{ $user->email }}
        </div>
    </div>

    @if(!empty($filter_info))
    <div class="filter-section">
        <div class="filter-title">Filter yang Diterapkan:</div>
        @foreach($filter_info as $filter)
            <div>• {{ $filter }}</div>
        @endforeach
    </div>
    @endif

    <div class="stats-section">
        <div class="filter-title">Statistik Data:</div>
        <div class="stats-grid">
            <div class="stats-item">
                <div class="stats-number">{{ $stats['total'] }}</div>
                <div class="stats-label">Total</div>
            </div>
            <div class="stats-item">
                <div class="stats-number" style="color: #059669;">{{ $stats['normal'] }}</div>
                <div class="stats-label">Normal</div>
            </div>
            <div class="stats-item">
                <div class="stats-number" style="color: #D97706;">{{ $stats['pendek'] }}</div>
                <div class="stats-label">Pendek</div>
            </div>
            <div class="stats-item">
                <div class="stats-number" style="color: #DC2626;">{{ $stats['sangat_pendek'] }}</div>
                <div class="stats-label">Sangat Pendek</div>
            </div>
            <div class="stats-item">
                <div class="stats-number" style="color: #7C3AED;">{{ $stats['tinggi'] }}</div>
                <div class="stats-label">Tinggi</div>
            </div>
        </div>
    </div>

    @if($measurements->count() > 0)
    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="10%">Tanggal</th>
                <th width="15%">NIK</th>
                <th width="18%">Nama Anak</th>
                <th width="8%">JK</th>
                <th width="10%">Tgl Lahir</th>
                <th width="8%">Usia</th>
                <th width="8%">Tinggi</th>
                <th width="8%">Z-Score</th>
                <th width="11%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($measurements as $index => $measurement)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $measurement->measurement_date->format('d/m/Y') }}</td>
                <td>{{ $measurement->child->nik }}</td>
                <td class="text-left">{{ $measurement->child->name }}</td>
                <td>{{ $measurement->child->gender == 'L' ? 'L' : 'P' }}</td>
                <td>{{ \Carbon\Carbon::parse($measurement->child->birth_date)->format('d/m/Y') }}</td>
                <td>{{ $measurement->age_months }}b</td>
                <td>{{ $measurement->height }}cm</td>
                <td>{{ number_format($measurement->z_score, 2) }}</td>
                <td class="
                    @if($measurement->status == 'Normal') status-normal
                    @elseif($measurement->status == 'Pendek') status-pendek
                    @elseif($measurement->status == 'Sangat Pendek') status-sangat-pendek
                    @elseif($measurement->status == 'Tinggi') status-tinggi
                    @endif
                ">
                    {{ $measurement->status }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div style="text-align: center; padding: 50px; color: #6B7280;">
        <h3>Tidak ada data untuk ditampilkan</h3>
        <p>Silakan ubah filter atau tambah data pengukuran.</p>
    </div>
    @endif

    <div class="footer">
        <div>
            Dokumen ini dibuat secara otomatis oleh Sistem Deteksi Stunting<br>
            Dicetak pada: {{ $export_date->format('d/m/Y H:i:s') }} WIB
        </div>
    </div>
</body>
</html>
