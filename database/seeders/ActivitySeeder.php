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
        DB::table('activities')->insert([
            'name' => 'Perjanjian Kinerja',
            'finance_code' => null,
            'division' => 'UMUM',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $activity = [
            [
                'name' => 'LAKIN',
                'finance_code' => null,
                'division' => 'UMUM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SPIP',
                'finance_code' => null,
                'division' => 'UMUM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Capaian Output SAKTI',
                'finance_code' => null,
                'division' => 'UMUM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Satu Data Indonesia (SDI)',
                'finance_code' => null,
                'division' => 'SDI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Evaluasi Penyelenggaraan Statistik Sektoral (EPSS)',
                'finance_code' => null,
                'division' => 'EPSS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Desa Cantik',
                'finance_code' => null,
                'division' => 'Desa Cantik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pojok Statistik',
                'finance_code' => null,
                'division' => 'Pojok Statistik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Reformasi Birokrasi dan Zona Integritas',
                'finance_code' => null,
                'division' => 'RB-ZI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Humas',
                'finance_code' => null,
                'division' => 'HUMAS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sakip',
                'finance_code' => null,
                'division' => 'SAKIP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sakernas',
                'finance_code' => null,
                'division' => 'SOSIAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Susenas Kor dan Konsumsi',
                'finance_code' => null,
                'division' => 'SOSIAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Susenas Modul Ketahanan Sosial',
                'finance_code' => null,
                'division' => 'SOSIAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Seruti',
                'finance_code' => null,
                'division' => 'SOSIAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pendataan Podes',
                'finance_code' => null,
                'division' => 'SOSIAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Penyusunan Statistik Politik dan Keamanan',
                'finance_code' => null,
                'division' => 'SOSIAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Prilaku Anti Korupsi',
                'finance_code' => null,
                'division' => 'SOSIAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pendataan Statistik Pertanian Tanaman Pangan Terintegrasi Dengan Metode Kerangka Sampel Area',
                'finance_code' => null,
                'division' => 'PRODUKSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Pertanian Tanaman Pangan/Ubinan',
                'finance_code' => null,
                'division' => 'PRODUKSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Holtikultura dan Indikator Pertanian',
                'finance_code' => null,
                'division' => 'PRODUKSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Perusahaan Pertanian',
                'finance_code' => null,
                'division' => 'PRODUKSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'IBS',
                'finance_code' => null,
                'division' => 'PRODUKSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'IMK',
                'finance_code' => null,
                'division' => 'PRODUKSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Pertambangan, Energi, Penggalian, Captive Power Dan Updating Direktori',
                'finance_code' => null,
                'division' => 'PRODUKSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Kontruksi',
                'finance_code' => null,
                'division' => 'PRODUKSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Distribusi',
                'finance_code' => null,
                'division' => 'DISTRIBUSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Harga',
                'finance_code' => null,
                'division' => 'DISTRIBUSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Keuangan dan Pariwisata',
                'finance_code' => null,
                'division' => 'DISTRIBUSI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Neraca Pengeluaraan',
                'finance_code' => null,
                'division' => 'NERACA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Neraca Produksi',
                'finance_code' => null,
                'division' => 'NERACA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Produksi dan Lingkungan Pertanian',
                'finance_code' => null,
                'division' => 'ST2023',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Ekonomi Pertanian',
                'finance_code' => null,
                'division' => 'ST2023',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Persiapan Sensus Ekonomi 2026',
                'finance_code' => null,
                'division' => 'SE2026',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Survei Kebutuhan Data (SKD)',
                'finance_code' => null,
                'division' => 'IPDS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('activities')->insert($activity);
    }
}
