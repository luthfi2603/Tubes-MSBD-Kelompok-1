<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        User::create([ // 1
            'username' => 'kelompok1',
            'status' => 'mahasiswa',
            'email' => 'kelompok1@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('1')
        ]);

        User::create([ // 2
            'username' => 'admin',
            'status' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('1')
        ]);
        
        User::create([ // 3
            'username' => 'super_admin',
            'status' => 'super_admin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('1')
        ]);
        
        User::create([ // 4
            'username' => 'ZeeroXc',
            'status' => 'mahasiswa',
            'email' => 'luthfim904@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('1')
        ]);
        
        User::create([ // 5
            'username' => 'IvanJaya',
            'status' => 'dosen',
            'email' => 'ivansanjaya@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('1')
        ]);
    }
}