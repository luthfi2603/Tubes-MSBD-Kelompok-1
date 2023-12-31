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
            'nim' => '181403014',
            'status' => 'Penulis',
            'karya_id' => '1'
        ]);
        KontributorMahasiswa::create([
            'nim' => '181405001',
            'status' => 'Penulis',
            'karya_id' => '2'
        ]);
        KontributorMahasiswa::create([
            'nim' => '181404023',
            'status' => 'Penulis',
            'karya_id' => '3'
        ]);
        KontributorMahasiswa::create([
            'nim' => '221402031',
            'status' => 'Penulis',
            'karya_id' => '6'
        ]);
        KontributorMahasiswa::create([
            'nim' => '171402050',
            'status' => 'Penulis',
            'karya_id' => '6'
        ]);
        KontributorMahasiswa::create([
            'nim' => '181405001',
            'status' => 'Penulis',
            'karya_id' => '4'
        ]);
        KontributorMahasiswa::create([
            'nim' => '181405001',
            'status' => 'Penulis',
            'karya_id' => '7'
        ]);
        KontributorMahasiswa::create([
            'nim' => '181401016',
            'status' => 'Penulis',
            'karya_id' => '8'
        ]);
        KontributorMahasiswa::create([
            'nim' => '221402031',
            'status' => 'Penulis',
            'karya_id' => '9'
        ]);
    }
}