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
            'kata_kunci' => 'AI'
        ]);
        KataKunci::create([
            'kata_kunci' => 'VR'
        ]);
        KataKunci::create([
            'kata_kunci' => 'AR'
        ]);
        KataKunci::create([
            'kata_kunci' => 'Image processing'
        ]);
        KataKunci::create([
            'kata_kunci' => 'Computer'
        ]);
        KataKunci::create([
            'kata_kunci' => 'Cloud Computing'
        ]);
        KataKunci::create([
            'kata_kunci' => 'Mathematics'
        ]);
    }
}