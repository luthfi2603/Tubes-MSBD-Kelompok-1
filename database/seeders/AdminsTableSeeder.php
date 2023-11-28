<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'nama' => 'Maia Cibebe',
            'user_id' => '2'
        ]);
        
        Admin::create([
            'nama' => 'Pak Andri',
            'user_id' => '3'
        ]);
    }
}