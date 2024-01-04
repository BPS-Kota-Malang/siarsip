<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomEmployeeTemplateExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([
            // Header
            ['No', 'Nama Pegawai', 'Divisi', 'NIP', 'Email', 'Pangkat'],
            // array_fill(0, 12, ''), // Filler untuk kolom A-L (indeks 0-11)
            // ['', '', '', '', '', '', '', '', '', '', '', '', 'Keterangan: Silakan isi data pegawai sesuai dengan format yang diberikan di bawah ini'],
            // array_fill(0, 12, ''), // Filler untuk kolom A-L (indeks 0-11)
            // ['', '', '', '', '', '', '', '', '', '', '', '', 'Kolom A', 'Nomor'],
            // ['', '', '', '', '', '', '', '', '', '', '', '', 'Kolom B', 'Nama Pegawai'],
            // ['', '', '', '', '', '', '', '', '', '', '', '', 'Kolom C', 'Divisi'],
            // ['', '', '', '', '', '', '', '', '', '', '', '', '1', 'Produksi'],
            // ['', '', '', '', '', '', '', '', '', '', '', '', '2', 'Sosial'],
            // ['', '', '', '', '', '', '', '', '', '', '', '', '3', 'Distribusi'],
            // ['', '', '', '', '', '', '', '', '', '', '', '', '4', 'IPDS'],
            // ['', '', '', '', '', '', '', '', '', '', '', '', '5', 'Neraca'],
            // ['', '', '', '', '', '', '', '', '', '', '', '', 'Kolom D', 'NIP'],
            // ['', '', '', '', '', '', '', '', '', '', '', '', 'Kolom E', 'ID User'],
            // ['', '', '', '', '', '', '', '', '', '', '', '', 'Kolom F', 'Pangkat']
        ]);

    }

    public function headings(): array
    {
        return [
            'nama',
            'division_id',
            'NIP',
            'user_id',
            'pangkat',
        ];
    }
}
