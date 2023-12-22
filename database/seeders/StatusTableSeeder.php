<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'nama_status' => 'penulis',
            'status' => '0'
        ]);

        Status::create([
            'nama_status' => 'kontributor',
            'status' => '0'
        ]);

        Status::create([
            'nama_status' => 'pembimbing 1',
            'status' => '1'
        ]);

        Status::create([
            'nama_status' => 'pembimbing 2',
            'status' => '1'
        ]);

        Status::create([
            'nama_status' => 'pembimbing 3',
            'status' => '1'
        ]);
    }
}
