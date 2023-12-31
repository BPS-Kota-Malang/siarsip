<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[1] !== null) {
            return new Employee([
                'nama' => $row[1],
                'division_id' => (int)$row[2],
                'NIP' => $row[3],
                'user_id' => $row[4],
                'pangkat' => $row[5],
            ]);
        }

        // Jika nilai 'nama' null, kembalikan null
        return null;

        // return new Employee([
        //     'nama' => $row[1],
        //     'division_id' => $row[2],
        //     'NIP' => $row[3],
        //     'user_id' => $row[4],
        //     'pangkat' => $row[5]
        // ]);
    }
}
