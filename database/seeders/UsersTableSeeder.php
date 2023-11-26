<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'kelompok1',
            'status' => 'civitas',
            'email' => 'kelompok1@gmail.com',
            'password' => bcrypt('1')
        ]);

        User::create([
            'username' => 'admin',
            'status' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1')
        ]);
        
        User::create([
            'username' => 'super_admin',
            'status' => 'super_admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('1')
        ]);
    }
}