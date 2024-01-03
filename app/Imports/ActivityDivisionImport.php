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
    protected $division;

    public function collection(Collection $rows)
    {

        foreach ($rows as $key => $row) {

            // Skip the header row
            if ($key === 0) {
                continue;
            }

            $number = $row[0];
            $divisionName = $row[1] ?? ($this->division instanceof Divisio? $this->division->name : null); // Use the previous division name if the current "Division" column is empty
            $activityName = $row[2];
            $financeCode = $row[3];

           if ( $divisionName !== null)
           {
             // Find or create the Division
             $division = Division::firstOrCreate([
                'Name' => $divisionName,
                'Code' => $number
            ]);

            // Set the current division to use in the next iteration
            $this->division = $divisionName;

            // Create the Activity and associate it with the Division
            $activity = new Activity([
                'name'          => $activityName,
                'finance_code'  => $financeCode,
                'division'      => $number
            ]);
            $activity->save();

            // Now you can save $number, $division, and $activity to the database or perform other actions.
           }
        }
    }
}
