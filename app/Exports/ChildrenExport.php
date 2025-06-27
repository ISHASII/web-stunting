<?php

namespace App\Exports;

use App\Models\Child;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ChildrenExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Child::select('nik', 'name', 'gender', 'birth_date', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['NIK', 'Nama', 'Jenis Kelamin', 'Tanggal Lahir', 'Dibuat Pada'];
    }
}
