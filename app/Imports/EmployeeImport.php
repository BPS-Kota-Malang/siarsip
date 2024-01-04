<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Division;
use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            // Skip header row
            if ($key === 0) {
                continue;
            }

            $number = $row[1];
            $divisionName = $row[2];
            $userEmail = $row[4];
            $username = $this->generateUsernameFromEmail($userEmail);

            // Use regex to validate and extract domain
            $validDomain = preg_match('/@bps\.go\.id$/', $userEmail);

            // If the domain is valid, proceed
            if ($validDomain) {
                // Find or create the Division
                $division = Division::firstOrCreate([
                    'name' => $divisionName,
                    'code' => $number
                ]);

                // Find or create the User
                $user = User::firstOrCreate(['email' => $userEmail], [
                    'name' => $row[1],
                    'email' => $userEmail,
                    'username' => $username,
                    'password' => bcrypt('3573'),
                ]);

                // Create the Employee and associate it with the Division and User
                Employee::create([
                    'nama' => $row[1],
                    'division_id' => $division->id,
                    'NIP' => $row[3],
                    'user_id' => $user->id,
                    'pangkat' => $row[5],
                ]);
            } else {
                // Handle invalid email domain here (e.g., log, skip, or throw exception)
                // For now, I'm skipping invalid emails
                continue;
            }
        }
    }

    /**
     * Generate username from email.
     *
     * @param string $email
     * @return string
     */
    private function generateUsernameFromEmail($email)
    {
        $emailParts = explode('@', $email);
        $username = strtolower(str_replace(' ', '', $emailParts[0]));
        return $username;
    }


        // foreach ($rows as $key => $row) {
        //     // Skip header row
        //     if ($key === 0) {
        //         continue;
        //     }
        //     $number = $row[1];
        //     $divisionName = $row[2]; // assuming Divisi is at index 2
        //     $userEmail = $row[4]; // assuming Email is at index 4

        //     // Find or create the Division
        //     $division = Division::firstOrCreate([
        //         'name' => $divisionName,
        //         'code' => $number
        //     ]);

        //     // Find or create the User
        //     $user = User::firstOrCreate(['email' => $userEmail], [
        //         'name' => $row[1], // assuming Nama Pegawai is at index 1
        //         'email' => $userEmail,
        //         'password' => bcrypt($row[6]), // assuming Password is at index 6
        //     ]);

        //     // Create the Employee and associate it with the Division and User
        //     Employee::create([
        //         'nama' => $row[1], // assuming Nama Pegawai is at index 1
        //         'division_id' => $division->id,
        //         'NIP' => $row[3], // assuming NIP is at index 3
        //         'user_id' => $user->id,
        //         'pangkat' => $row[7], // assuming Pangkat is at index 7
        //     ]);
        // }
    }

