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
    protected $divisionNonEmpty;

    public function collection(Collection $rows)
    {

        foreach ($rows as $key => $row) {

            // Skip the header row
            if ($key === 0) {
                continue;
            }

            $number = $row[0];
            $divisionName = $row[1] !== null ? $row[1] : $this->divisionNonEmpty;
            $activityName = $row[2];
            $financeCode = $row[3];

            if ( $divisionName !== null)
            {
             // Find or create the Division
            $division = Division::firstOrCreate([
                'Name' => $divisionName,
                'Code' => $number
            ]);

            $divisionID = $division->id;

            // Set the current division to use in the next iteration
            $this->divisionNonEmpty = $division -> name;

            // Create the Activity and associate it with the Division
            $activity = new Activity([
                'name'          => $activityName,
                'finance_code'  => $financeCode,
                'division_id'   => $divisionID
            ]);
            $activity->save();

            // Now you can save $number, $division, and $activity to the database or perform other actions.
           }
        }
    }
}
