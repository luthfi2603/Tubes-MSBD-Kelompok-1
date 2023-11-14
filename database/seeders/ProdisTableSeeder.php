<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prodi::create([
            'kode_prodi' => '01',
            'nama_prodi' => 'Ilmu Komputer',
            'jenjang' => 'S1'
        ]);

        Prodi::create([
            'kode_prodi' => '02',
            'nama_prodi' => 'Teknologi Informasi',
            'jenjang' => 'S1'
        ]);

        Prodi::create([
            'kode_prodi' => '03',
            'nama_prodi' => 'Teknik Informatika',
            'jenjang' => 'S2'
        ]);

        Prodi::create([
            'kode_prodi' => '04',
            'nama_prodi' => 'Sains Data dan Kecerdasan Buatan',
            'jenjang' => 'S2'
        ]);

        Prodi::create([
            'kode_prodi' => '05',
            'nama_prodi' => 'Ilmu Komputer',
            'jenjang' => 'S3'
        ]);
    }
}