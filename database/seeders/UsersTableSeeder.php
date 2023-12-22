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
            'password' => bcrypt('password')
        ]);

        User::create([ // 2
            'username' => 'admin',
            'status' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('admin')
        ]);
        
        User::create([ // 3
            'username' => 'super_admin',
            'status' => 'super_admin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('superadmin')
        ]);
        
        User::create([ // 4
            'username' => 'ZeeroXc',
            'status' => 'mahasiswa',
            'email' => 'luthfim904@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password')
        ]);
        
        User::create([ // 5
            'username' => 'IvanJaya',
            'status' => 'dosen',
            'email' => 'ivansanjaya@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password')
        ]);

        User::create([ // 6
            'username' => 'Fortyche',
            'status' => 'mahasiswa',
            'email' => 'rifqijabrah@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password')
        ]);

        User::create([ // 7
            'username' => 'Ghalbi',
            'status' => 'admin',
            'email' => 'ghalbih@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password')
        ]);

        User::create([ // 8
            'username' => 'Aulia',
            'status' => 'admin',
            'email' => 'aulia@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password')
        ]);

        User::create([ // 9
            'username' => 'Edgar',
            'status' => 'admin',
            'email' => 'serafim@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password')
        ]);

        User::create([ // 10
            'username' => 'Jessindy',
            'status' => 'admin',
            'email' => 'jessindy@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password')
        ]);
        
        User::create([ // 11
            'username' => 'DedyArisandi',
            'status' => 'dosen',
            'email' => 'dedyarisandi@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password')
        ]);
    }
}