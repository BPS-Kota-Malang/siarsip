<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class CustomActivityTemplateExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([
            // Header
            ['No','Divisi', 'Nama Kegiatan', 'Kode Finance'],
        ]);
    }

    public function headings(): array
    {
        return [
            'division_id',
            'name',
            'finance_code',
        ];
    }
}
