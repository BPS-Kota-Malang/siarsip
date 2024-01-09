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
            if ($key === 0) {
                continue;
            }

            $number = $row[1];
            $divisionName = $row[2];
            $userEmail = $row[4];
            $username = $this->generateUsernameFromEmail($userEmail);

            $validDomain = preg_match('/@bps\.go\.id$/', $userEmail);

            if ($validDomain) {
                $division = Division::where('name', $divisionName)->first();

                if (!$division) {
                    $division = Division::create([
                        'name' => $divisionName,
                        'code' => uniqid(),
                    ]);
                }

                $user = User::firstOrCreate(['email' => $userEmail], [
                    'name' => $row[1],
                    'email' => $userEmail,
                    'username' => $username,
                    'password' => bcrypt('3573'),
                    'role' => 'anggota',
                ]);

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
}

