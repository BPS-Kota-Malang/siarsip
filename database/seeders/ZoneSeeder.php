<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 'persiapan', 'pelaksanaan', 'pengolahan', 'diseminasi', 'laporan', 'dokumentasi'
        $zone = [
            [
                'name' => 'Manajemen Perubahan',
            ],
            [
                'name' => 'Penataan Tata Laksana',
            ],
            [
                'name' => 'Penataan Sistem Manajemen SDM',
            ],
            [
                'name' => 'Penguatan Akuntabilitas Kinerja',
            ],
            [
                'name' => 'Penguatan Pengawasan',
            ],
            [
                'name' => 'Peningkatan Kualitas Pelayanan Publik',
            ],
        ];

        DB::table('zones')->insert($zone);
    }
}
