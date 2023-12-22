<?php

namespace Database\Seeders;

use App\Models\KontributorDosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontributorDosenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KontributorDosen::create([
            'nidn' => '0004097901',
            'status' => 'pembimbing 1',
            'karya_id' => '1'
        ]);

        KontributorDosen::create([
            'nidn' => '0010116706',
            'status' => 'pembimbing 1',
            'karya_id' => '2'
        ]);

        KontributorDosen::create([
            'nidn' => '0008017906',
            'status' => 'pembimbing 1',
            'karya_id' => '3'
        ]);

        KontributorDosen::create([
            'nidn' => '0107078404',
            'status' => 'penulis',
            'karya_id' => '4'
        ]);
        KontributorDosen::create([
            'nidn' => '0107078404',
            'status' => 'pembimbing 1',
            'karya_id' => '6'
        ]);
        KontributorDosen::create([
            'nidn' => '0031087905',
            'status' => 'penulis',
            'karya_id' => '5'
        ]);
        KontributorDosen::create([
            'nidn' => '0101058801',
            'status' => 'pembimbing 1',
            'karya_id' => '8'
        ]);
        
    }
}