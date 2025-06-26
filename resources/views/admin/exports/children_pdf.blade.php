<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Anak</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <h2>Data Anak</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Umur (bulan)</th>
                <th>Status Terakhir</th>
                <th>Jumlah Pengukuran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($children as $i => $child)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $child->nik }}</td>
                    <td>{{ $child->name }}</td>
                    <td>{{ $child->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $child->age_in_months }} bulan</td>
                    <td>
                        {{ optional($child->latest_measurement)->status ?? 'Belum diukur' }}
                    </td>
                    <td>{{ $child->measurements->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
