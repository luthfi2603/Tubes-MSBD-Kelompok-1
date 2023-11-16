<?php

namespace Database\Seeders;

use App\Models\JenisTulisan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisTulisanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisTulisan::create([
            'jenis_tulisan' => 'Skripsi'
        ]);
    }
}
