<?php

namespace App\Exports;

use App\Models\Child;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class SingleChildExport implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    protected $child;

    public function __construct(Child $child)
    {
        $this->child = $child;
    }

    public function collection()
    {
        $measurements = $this->child->measurements()->orderBy('measurement_date', 'desc')->get();
        $latestMeasurement = $measurements->first();

        $data = collect([
            // Child basic info
            [
                'Kategori' => 'INFORMASI ANAK',
                'Keterangan' => 'NIK',
                'Nilai' => $this->child->nik,
                'Tanggal' => '',
                'Status' => '',
                'Z-Score' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Nama Lengkap',
                'Nilai' => $this->child->name,
                'Tanggal' => '',
                'Status' => '',
                'Z-Score' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Jenis Kelamin',
                'Nilai' => $this->child->gender == 'L' ? 'Laki-laki' : 'Perempuan',
                'Tanggal' => '',
                'Status' => '',
                'Z-Score' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Tanggal Lahir',
                'Nilai' => $this->child->birth_date ? $this->child->birth_date : '-',
                'Tanggal' => '',
                'Status' => '',
                'Z-Score' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Umur Saat Ini',
                'Nilai' => floor($this->child->age_in_months) . ' bulan',
                'Tanggal' => '',
                'Status' => '',
                'Z-Score' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Tinggi Badan Terakhir',
                'Nilai' => $latestMeasurement ? floor((float)$latestMeasurement->height) . ' cm' : 'Belum diukur',
                'Tanggal' => '',
                'Status' => '',
                'Z-Score' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Berat Badan Terakhir',
                'Nilai' => $latestMeasurement && $latestMeasurement->weight ? number_format((float)$latestMeasurement->weight, 1) . ' kg' : 'Belum diukur',
                'Tanggal' => '',
                'Status' => '',
                'Z-Score' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Lingkar Kepala Terakhir',
                'Nilai' => $latestMeasurement && $latestMeasurement->head_circumference ? number_format((float)$latestMeasurement->head_circumference, 1) . ' cm' : 'Belum diukur',
                'Tanggal' => '',
                'Status' => '',
                'Z-Score' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Lingkar Lengan Atas Terakhir',
                'Nilai' => $latestMeasurement && $latestMeasurement->arm_circumference ? number_format((float)$latestMeasurement->arm_circumference, 1) . ' cm' : 'Belum diukur',
                'Tanggal' => '',
                'Status' => '',
                'Z-Score' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Status Gizi Terakhir',
                'Nilai' => $latestMeasurement ? $latestMeasurement->status : 'Belum ada data',
                'Tanggal' => '',
                'Status' => '',
                'Z-Score' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => 'Total Pengukuran',
                'Nilai' => $measurements->count() . ' kali',
                'Tanggal' => '',
                'Status' => '',
                'Z-Score' => ''
            ],
            [
                'Kategori' => '',
                'Keterangan' => '',
                'Nilai' => '',
                'Tanggal' => '',
                'Status' => '',
                'Z-Score' => ''
            ]
        ]);

            // Add measurements header
        if ($measurements->count() > 0) {
            $data->push([
                'Kategori' => 'RIWAYAT PENGUKURAN',
                'Keterangan' => 'Umur (Bulan)',
                'Nilai' => 'Tinggi (cm) / Berat (kg) / LK (cm) / LLA (cm)',
                'Tanggal' => 'Tanggal Pengukuran',
                'Status' => 'Status Gizi',
                'Z-Score' => 'Z-Score'
            ]);

            // Add each measurement
            foreach ($measurements as $measurement) {
                $heightValue = floor((float)$measurement->height) . ' cm';
                $weightValue = $measurement->weight ? number_format((float)$measurement->weight, 1) . ' kg' : '-';
                $headCircumferenceValue = $measurement->head_circumference ? number_format((float)$measurement->head_circumference, 1) . ' cm' : '-';
                $armCircumferenceValue = $measurement->arm_circumference ? number_format((float)$measurement->arm_circumference, 1) . ' cm' : '-';
                $combinedValue = $heightValue . ' / ' . $weightValue . ' / ' . $headCircumferenceValue . ' / ' . $armCircumferenceValue;

                $data->push([
                    'Kategori' => '',
                    'Keterangan' => $measurement->age_months . ' bulan',
                    'Nilai' => $combinedValue,
                    'Tanggal' => $measurement->measurement_date->format('d/m/Y'),
                    'Status' => $measurement->status,
                    'Z-Score' => number_format((float)$measurement->z_score, 2)
                ]);
            }
        } else {
            $data->push([
                'Kategori' => 'RIWAYAT PENGUKURAN',
                'Keterangan' => 'Belum ada pengukuran',
                'Nilai' => '-',
                'Tanggal' => '-',
                'Status' => '-',
                'Z-Score' => '-'
            ]);
        }

        return $data;
    }

    public function headings(): array
    {
        return ['Kategori', 'Keterangan', 'Nilai', 'Tanggal', 'Status', 'Z-Score'];
    }

    public function title(): string
    {
        return 'Data Anak - ' . $this->child->name;
    }

    public function styles(Worksheet $sheet)
    {
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

            // All data styling
            "A2:F{$rowCount}" => [
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

            // Category column (A) - bold and center
            "A2:A{$rowCount}" => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => '1E40AF'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F0F9FF'],
                ],
            ],

            // Description column (B) - left aligned
            "B2:B{$rowCount}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
                'font' => [
                    'bold' => true,
                ],
            ],

            // Value column (C) - left aligned
            "C2:C{$rowCount}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ],

            // Date column (D) - center aligned
            "D2:D{$rowCount}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],

            // Status column (E) - center aligned
            "E2:E{$rowCount}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],

            // Z-Score column (F) - center aligned
            "F2:F{$rowCount}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],

            // Special styling for section headers
            'A2' => [ // INFORMASI ANAK
                'font' => [
                    'bold' => true,
                    'size' => 11,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '059669'],
                ],
            ],

            // Find and style RIWAYAT PENGUKURAN row
            'A11' => [ // Assuming this is around row 11, adjust if needed
                'font' => [
                    'bold' => true,
                    'size' => 11,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'DC2626'],
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,  // Kategori
            'B' => 25,  // Keterangan
            'C' => 20,  // Nilai
            'D' => 15,  // Tanggal
            'E' => 18,  // Status
            'F' => 12,  // Z-Score
        ];
    }
}