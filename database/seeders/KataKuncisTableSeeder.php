<?php

namespace Database\Seeders;

use App\Models\KataKunci;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KataKuncisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KataKunci::create([
            'kata_kunci' => 'Database'
        ]);
        KataKunci::create([
            'kata_kunci' => 'Web'
        ]);
        KataKunci::create([
            'kata_kunci' => 'Ular'
        ]);
        KataKunci::create([
            'kata_kunci' => 'Kucing'
        ]);
        KataKunci::create([
            'kata_kunci' => 'Kambing'
        ]);
        KataKunci::create([
            'kata_kunci' => 'Ayam'
        ]);
        KataKunci::create([
            'kata_kunci' => 'Sihir'
        ]);
    }
}