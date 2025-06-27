<?php

namespace App\Exports;

use App\Models\Child;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SingleChildExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    protected $child;

    public function __construct(Child $child)
    {
        $this->child = $child;
    }

    public function collection()
    {
        $measurements = $this->child->measurements()->orderBy('measurement_date', 'desc')->get();

        $data = collect([
            // Child basic info
            [
                'Kategori' => 'INFORMASI ANAK',
                'Keterangan' => 'NIK',
                'Nilai' => $this->child->nik,
                'Tanggal' => '',
                'Status' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Nama',
                'Nilai' => $this->child->name,
                'Tanggal' => '',
                'Status' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Jenis Kelamin',
                'Nilai' => $this->child->gender == 'L' ? 'Laki-laki' : 'Perempuan',
                'Tanggal' => '',
                'Status' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Tanggal Lahir',
                'Nilai' => $this->child->birth_date->format('d/m/Y'),
                'Tanggal' => '',
                'Status' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Umur Saat Ini',
                'Nilai' => $this->child->age_in_months . ' bulan',
                'Tanggal' => '',
                'Status' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => '',
                'Nilai' => '',
                'Tanggal' => '',
                'Status' => ''
            ]
        ]);

        // Add measurements header
        if ($measurements->count() > 0) {
            $data->push([
                'Kategori' => 'RIWAYAT PENGUKURAN',
                'Keterangan' => 'Umur (Bulan)',
                'Nilai' => 'Tinggi Badan (cm)',
                'Tanggal' => 'Tanggal Pengukuran',
                'Status' => 'Status Gizi'
            ]);

            // Add each measurement
            foreach ($measurements as $measurement) {
                $data->push([
                    'Kategori' => '',
                    'Keterangan' => $measurement->age_months,
                    'Nilai' => $measurement->height,
                    'Tanggal' => $measurement->measurement_date->format('d/m/Y'),
                    'Status' => $measurement->status
                ]);
            }
        } else {
            $data->push([
                'Kategori' => 'RIWAYAT PENGUKURAN',
                'Keterangan' => 'Belum ada pengukuran',
                'Nilai' => '',
                'Tanggal' => '',
                'Status' => ''
            ]);
        }

        return $data;
    }

    public function headings(): array
    {
        return ['Kategori', 'Keterangan', 'Nilai', 'Tanggal', 'Status'];
    }

    public function title(): string
    {
        return 'Data Anak - ' . $this->child->name;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A:E' => ['alignment' => ['horizontal' => 'left']],
        ];
    }
}
