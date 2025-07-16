<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class MeasurementExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, WithColumnWidths
{
    protected $measurements;
    protected $filters;

    public function __construct($measurements, $filters = [])
    {
        $this->measurements = $measurements;
        $this->filters = $filters;
    }

    public function collection()
    {
        return $this->measurements;
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Pengukuran',
            'NIK',
            'Nama Anak',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Usia (Bulan)',
            'Tinggi Badan (cm)',
            'Berat Badan (kg)',
            'Lingkar Kepala (cm)',
            'Lingkar Lengan Atas (cm)',
            'Z-Score',
            'Status Stunting',
            'Petugas'
        ];
    }

    public function map($measurement): array
    {
        static $no = 1;

        try {
            return [
                $no++,
                Carbon::parse($measurement->measurement_date)->format('d/m/Y'),
                $measurement->child->nik ?? 'N/A',
                $measurement->child->name ?? 'N/A',
                $measurement->child->gender == 'L' ? 'Laki-laki' : 'Perempuan',
                Carbon::parse($measurement->child->birth_date)->format('d/m/Y'),
                $measurement->age_months,
                $measurement->height,
                $measurement->weight ?? '-',
                $measurement->head_circumference ?? '-',
                $measurement->arm_circumference ?? '-',
                number_format($measurement->z_score, 2),
                $measurement->status,
                $measurement->user->name ?? 'N/A'
            ];
        } catch (\Exception $e) {
            \Log::error('Error mapping measurement data', [
                'measurement_id' => $measurement->id ?? 'unknown',
                'error' => $e->getMessage()
            ]);
            
            return [
                $no++,
                'Error',
                'Error',
                'Error',
                'Error',
                'Error',
                'Error',
                'Error',
                'Error',
                'Error',
                'Error',
                'Error'
            ];
        }
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the header row
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'color' => ['rgb' => '3B82F6']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            // Style all cells
            'A:N' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 18,  // Tanggal Pengukuran
            'C' => 20,  // NIK
            'D' => 25,  // Nama Anak
            'E' => 15,  // Jenis Kelamin
            'F' => 15,  // Tanggal Lahir
            'G' => 12,  // Usia
            'H' => 15,  // Tinggi Badan
            'I' => 15,  // Berat Badan
            'J' => 15,  // Lingkar Kepala
            'K' => 15,  // Lingkar Lengan Atas
            'L' => 12,  // Z-Score
            'M' => 18,  // Status
            'N' => 20,  // Petugas
        ];
    }

    public function title(): string
    {
        return 'Data Pengukuran';
    }
}