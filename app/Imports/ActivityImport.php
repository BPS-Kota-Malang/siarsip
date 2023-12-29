<?php

namespace App\Imports;

use App\Models\Activity;
use Maatwebsite\Excel\Concerns\ToModel;

class ActivityImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Activity([
            'name' => $row[1],
            'finance_code' => $row[2],
            'division' => $row[3],
        ]);
    }
}
