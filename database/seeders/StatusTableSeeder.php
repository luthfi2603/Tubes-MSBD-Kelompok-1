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
            'nama_status' => 'Penulis',
            'status' => '0'
        ]);

        Status::create([
            'nama_status' => 'Kontributor',
            'status' => '0'
        ]);

        Status::create([
            'nama_status' => 'Pembimbing 1',
            'status' => '1'
        ]);

        Status::create([
            'nama_status' => 'Pembimbing 2',
            'status' => '1'
        ]);

        Status::create([
            'nama_status' => 'Pembimbing 3',
            'status' => '1'
        ]);
    }
}
