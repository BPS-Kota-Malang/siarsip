<?php

namespace Database\Seeders;

use App\Models\Phase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 'persiapan', 'pelaksanaan', 'pengolahan', 'diseminasi', 'laporan', 'dokumentasi'
        $phase = [
            [
                'name' => 'persiapan',
            ],
            [
                'name' => 'pelaksanaan',
            ],
            [
                'name' => 'pengolahan',
            ],
            [
                'name' => 'diseminasi',
            ],
            [
                'name' => 'laporan',
            ],
        ];

        DB::table('phases')->insert($phase);
    }
}
