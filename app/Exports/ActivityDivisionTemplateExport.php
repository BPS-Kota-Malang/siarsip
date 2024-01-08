<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\Activity;
use App\Models\Division;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivityDivisionTemplateExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Collection::make();
        return $data;

    }

    public function headings(): array
    {
        return [
            'no',
            'Tim Kerja',
            'Kegiatan',
            'Kode POK',
        ];
    }
}
