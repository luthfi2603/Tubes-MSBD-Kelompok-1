<?php

namespace Database\Seeders;

use App\Models\KontributorMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontributorMahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KontributorMahasiswa::create([
            'nim' => '221402031',
            'status' => 'penulis',
            'karya_id' => '1'
        ]);
        KontributorMahasiswa::create([
            'nim' => '221402050',
            'status' => 'penulis',
            'karya_id' => '2'
        ]);
        KontributorMahasiswa::create([
            'nim' => '221402053',
            'status' => 'penulis',
            'karya_id' => '3'
        ]);
    }
}
