<?php

namespace Database\Seeders;

use App\Models\BidangIlmu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangIlmuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'IoT'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'AI'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'VR'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'Data Science'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'Machine Learning'
        ]);
    }
}
