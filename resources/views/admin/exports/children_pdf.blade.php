<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Anak - Sistem Deteksi Stunting</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #3B82F6;
            padding-bottom: 15px;
        }

        .header h1 {
            color: #1E40AF;
            font-size: 20px;
            margin: 0 0 5px 0;
            font-weight: bold;
        }

        .header h2 {
            color: #3B82F6;
            font-size: 14px;
            margin: 0;
            font-weight: normal;
        }

        .info-section {
            margin-bottom: 20px;
            background-color: #F8FAFC;
            padding: 12px;
            border-radius: 5px;
            border-left: 4px solid #3B82F6;
        }

        .info-row {
            display: inline-block;
            width: 48%;
            margin-bottom: 5px;
            font-size: 10px;
        }

        .stats-section {
            margin-bottom: 20px;
            background-color: #F0FDF4;
            padding: 12px;
            border-radius: 5px;
            text-align: center;
        }

        .stats-title {
            font-weight: bold;
            color: #065F46;
            margin-bottom: 8px;
            font-size: 12px;
        }

        .stats-number {
            font-size: 18px;
            font-weight: bold;
            color: #059669;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        th {
            background: linear-gradient(to bottom, #3B82F6, #2563EB);
            color: black;
            padding: 10px 6px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #2563EB;
            font-size: 9px;
        }

        td {
            padding: 8px 6px;
            border: 1px solid #D1D5DB;
            text-align: center;
            font-size: 9px;
            background-color: #FAFAFA;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .status-normal {
            background-color: #D1FAE5;
            color: #065F46;
            font-weight: bold;
            padding: 3px 6px;
            border-radius: 3px;
        }

        .status-pendek {
            background-color: #FED7AA;
            color: #9A3412;
            font-weight: bold;
            padding: 3px 6px;
            border-radius: 3px;
        }

        .status-sangat-pendek {
            background-color: #FECACA;
            color: #991B1B;
            font-weight: bold;
            padding: 3px 6px;
            border-radius: 3px;
        }

        .status-tinggi {
            background-color: #E0E7FF;
            color: #3730A3;
            font-weight: bold;
            padding: 3px 6px;
            border-radius: 3px;
        }

        .status-belum {
            background-color: #F3F4F6;
            color: #6B7280;
            font-style: italic;
            padding: 3px 6px;
            border-radius: 3px;
        }

        .footer {
            margin-top: 30px;
            border-top: 1px solid #D1D5DB;
            padding-top: 15px;
            text-align: right;
            font-size: 8px;
            color: #6B7280;
        }

        tr:nth-child(even) td {
            background-color: #F9FAFB;
        }

        tr:hover td {
            background-color: #EFF6FF;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #6B7280;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA ANAK</h1>
        <h2>Sistem Deteksi Stunting pada Anak</h2>
    </div>

    <div class="info-section">
        <div class="info-row">
            <strong>Tanggal Cetak:</strong> {{ now()->format('d/m/Y H:i:s') }}
        </div>
        <div class="info-row">
            <strong>Total Data:</strong> {{ $children->count() }} anak
        </div>
        @if(auth()->user())
        <div class="info-row">
            <strong>Dicetak oleh:</strong> {{ auth()->user()->name }}
        </div>
        <div class="info-row">
            <strong>Email:</strong> {{ auth()->user()->email }}
        </div>
        @endif
    </div>

    <div class="stats-section">
        <div class="stats-title">Total Anak Terdaftar</div>
        <div class="stats-number">{{ $children->count() }}</div>
    </div>

    @if($children->count() > 0)
    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="12%">NIK</th>
                <th width="16%">Nama Anak</th>
                <th width="6%">JK</th>
                <th width="6%">Umur</th>
                <th width="8%">Tinggi</th>
                <th width="8%">Berat</th>
                <th width="7%">LK</th>
                <th width="7%">LLA</th>
                <th width="12%">Status</th>
                <th width="8%">Jml Ukur</th>
                <th width="6%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($children as $i => $child)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-center" style="font-family: monospace; background-color: #F3F4F6;">
                        {{ $child->nik }}
                    </td>
                    <td class="text-left" style="font-weight: 500;">
                        {{ $child->name }}
                    </td>
                    <td class="text-center">
                        {{ $child->gender === 'L' ? 'L' : 'P' }}
                    </td>
                    <td class="text-center">
                        {{ floor($child->age_in_months) }}b
                    </td>
                    <td class="text-center">
                        @if($child->latest_measurement && $child->latest_measurement->height)
                            {{ floor($child->latest_measurement->height) }}cm
                        @else
                            <span style="color: #9CA3AF;">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($child->latest_measurement && $child->latest_measurement->weight)
                            {{ number_format($child->latest_measurement->weight, 1) }}kg
                        @else
                            <span style="color: #9CA3AF;">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($child->latest_measurement && $child->latest_measurement->head_circumference)
                            {{ number_format($child->latest_measurement->head_circumference, 1) }}cm
                        @else
                            <span style="color: #9CA3AF;">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($child->latest_measurement && $child->latest_measurement->arm_circumference)
                            {{ number_format($child->latest_measurement->arm_circumference, 1) }}cm
                        @else
                            <span style="color: #9CA3AF;">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @php
                            $status = optional($child->latest_measurement)->status ?? 'Belum diukur';
                        @endphp

                        @if($status == 'Normal')
                            <span class="status-normal">{{ $status }}</span>
                        @elseif($status == 'Pendek')
                            <span class="status-pendek">{{ $status }}</span>
                        @elseif($status == 'Sangat Pendek')
                            <span class="status-sangat-pendek">{{ $status }}</span>
                        @elseif($status == 'Tinggi')
                            <span class="status-tinggi">{{ $status }}</span>
                        @else
                            <span class="status-belum">{{ $status }}</span>
                        @endif
                    </td>
                    <td class="text-center" style="font-weight: 500;">
                        {{ $child->measurements->count() }}x
                    </td>
                    <td class="text-center">
                        @if($child->measurements->count() > 0)
                            <span style="color: #059669;">✓</span>
                        @else
                            <span style="color: #DC2626;">○</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">
        <h3>Tidak ada data anak untuk ditampilkan</h3>
        <p>Silakan tambah data anak terlebih dahulu.</p>
    </div>
    @endif

    <div class="footer">
        <div>
            Dokumen ini dibuat secara otomatis oleh Sistem Deteksi Stunting<br>
            Dicetak pada: {{ now()->format('d/m/Y H:i:s') }} WIB
        </div>
    </div>
</body>
</html>
