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
            'jenis_bidang_ilmu' => 'Internet of Things'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'Artificial Intelligence'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'Virtual Reality'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'Augmented Reality'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'Data Science'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'Machine Learning'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'Crypthography'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'Database'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'Image Processing'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'Robotics'
        ]);
        BidangIlmu::create([
            'jenis_bidang_ilmu' => 'Computer Vision'
        ]);
    }
}
