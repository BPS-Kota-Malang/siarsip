<?php

namespace App\Imports;

use App\Models\Activity;
use App\Models\Division;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class ActivityDivisionImport implements ToCollection
{
    protected $divisionNameNonEmpty;
    protected $divisionCodeNonEmpty;

    public function collection(Collection $rows)
    {
        // $divisionNonEmpty = null;

        foreach ($rows as $key => $row) {

            // Skip the header row
            if ($key === 0) {
                continue;
            }

            $number = $row[0] !== null ? $row[0] : $this->divisionCodeNonEmpty;
            $divisionName = $row[1] !== null ? $row[1] : $this->divisionNameNonEmpty;
            $activityName = $row[2];
            $financeCode = $row[3];

            if ( $divisionName !== null)
            {
             // Find or create the Division
            $division = Division::firstOrCreate([
                'name' => $divisionName,
                'code' => $number
            ]);

            // $divisionID = $division->id;

            // Set the current division to use in the next iteration
            $this->divisionNameNonEmpty = $division -> name;
            $this->divisionCodeNonEmpty = $division -> code;

            // Create the Activity and associate it with the Division
            $activity = new Activity([
                'name'          => $activityName,
                'finance_code'  => $financeCode,
                'division_id'   => $division->id
            ]);
            $activity->save();

            // Now you can save $number, $division, and $activity to the database or perform other actions.
           }
        }
    }
}
