<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan satu baris data
        DB::table('activity')->insert([
            'name' => 'Sensus Pertanian 2023',
            'finance_code' => 'A123',
            'division' => 'Produksi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $activity = [
            [
                'name' => 'Rapat Koordinasi',
                'finance_code' => 'R1456',
                'division' => 'IPDS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Ubinan KSA',
                'finance_code' => 'A896',
                'division' => 'Produksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kunjungan SMP Malang',
                'finance_code' => 'B876',
                'division' => 'Sosial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Perjalanan Dinas',
                'finance_code' => 'H456',
                'division' => 'Distribusi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rapat Koordinasi',
                'finance_code' => 'R1456',
                'division' => 'IPDS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Apel Pagi ASIK',
                'finance_code' => 'J876',
                'division' => 'IPDS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('activity')->insert($activity);
    }
}
