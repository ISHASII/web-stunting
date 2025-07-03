<?php

namespace App\Exports;

use App\Models\Child;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ChildrenExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle, WithMapping
{
    protected $children;

    public function __construct($children = null)
    {
        $this->children = $children;
    }

    public function collection()
    {
        if ($this->children) {
            // If children is already a collection, load the relationships
            return $this->children->load(['measurements' => function($query) {
                $query->latest('measurement_date');
            }]);
        }

        // If no children provided, query all children with measurements
        return Child::with(['measurements' => function($query) {
            $query->latest('measurement_date');
        }])->orderBy('created_at', 'desc')->get();
    }

    public function map($child): array
    {
        $latestMeasurement = $child->measurements->first();

        return [
            $child->nik,
            $child->name,
            $child->gender === 'L' ? 'Laki-laki' : 'Perempuan',
            $child->birth_date ? \Carbon\Carbon::parse($child->birth_date)->format('d/m/Y') : '-',
            floor($child->age_in_months) . ' bulan',
            $latestMeasurement ? floor($latestMeasurement->height) . ' cm' : 'Belum diukur',
            $latestMeasurement && $latestMeasurement->weight ? number_format((float)$latestMeasurement->weight, 1) . ' kg' : 'Belum diukur',
            $latestMeasurement ? $latestMeasurement->status : 'Belum diukur',
            $child->measurements->count() . ' kali',
            $child->created_at->format('d/m/Y'),
        ];
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama Anak',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Usia',
            'Tinggi Terakhir',
            'Berat Terakhir',
            'Status Terakhir',
            'Total Pengukuran',
            'Terdaftar Pada',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Get the actual row count from the collection
        $collection = $this->collection();
        $rowCount = $collection->count() + 1; // +1 untuk header

        return [
            // Header styling
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 12,
                    'name' => 'Arial',
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1E40AF'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THICK,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],

            // Data rows styling
            "A2:I{$rowCount}" => [
                'font' => [
                    'size' => 10,
                    'name' => 'Arial',
                ],
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

            // NIK column - center aligned
            "A2:A{$rowCount}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
                'font' => [
                    'name' => 'Courier New', // Monospace for NIK
                ],
            ],

            // Name column - left aligned
            "B2:B{$rowCount}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
                'font' => [
                    'bold' => true,
                ],
            ],

            // Gender, Age, Height, Status, Count - center aligned
            "C2:C{$rowCount}" => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            "D2:D{$rowCount}" => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            "E2:E{$rowCount}" => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            "F2:F{$rowCount}" => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            "G2:G{$rowCount}" => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            "H2:H{$rowCount}" => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            "I2:I{$rowCount}" => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            "J2:J{$rowCount}" => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],

            // Alternating row colors for better readability
            "A2:J" . ($rowCount % 2 == 0 ? $rowCount : $rowCount - 1) => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F8FAFC'],
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18,  // NIK
            'B' => 25,  // Nama Anak
            'C' => 15,  // Jenis Kelamin
            'D' => 15,  // Tanggal Lahir
            'E' => 12,  // Usia
            'F' => 15,  // Tinggi Terakhir
            'G' => 15,  // Berat Terakhir
            'H' => 18,  // Status Terakhir
            'I' => 15,  // Total Pengukuran
            'J' => 15,  // Terdaftar Pada
        ];
    }

    public function title(): string
    {
        return 'Data Anak Stunting';
    }
}
