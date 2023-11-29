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
            'nidn' => '0031087905',
            'status' => 'pembimbing',
            'karya_id' => '1'
        ]);
        KontributorDosen::create([
            'nidn' => '0107078404',
            'status' => 'pembimbing',
            'karya_id' => '1'
        ]);

        KontributorDosen::create([
            'nidn' => '0031087905',
            'status' => 'pembimbing',
            'karya_id' => '2'
        ]);
        KontributorDosen::create([
            'nidn' => '0107078404',
            'status' => 'pembimbing',
            'karya_id' => '2'
        ]);

        KontributorDosen::create([
            'nidn' => '0031087905',
            'status' => 'pembimbing',
            'karya_id' => '3'
        ]);
        KontributorDosen::create([
            'nidn' => '0107078404',
            'status' => 'pembimbing',
            'karya_id' => '3'
        ]);
        KontributorDosen::create([
            'nidn' => '0107078404',
            'status' => 'penulis',
            'karya_id' => '4'
        ]);
        KontributorDosen::create([
            'nidn' => '0031087905',
            'status' => 'penulis',
            'karya_id' => '5'
        ]);
        
    }
}