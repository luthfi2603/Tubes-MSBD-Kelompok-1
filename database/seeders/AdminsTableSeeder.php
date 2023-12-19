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
        Admin::create([ // 1
            'nama' => 'Maia Cibebe',
            'user_id' => '2'
        ]);
        
        Admin::create([ // 2
            'nama' => 'wahyu jhon',
            'user_id' => '3'
        ]);

        Admin::create([ // 3
            'nama' => 'serafim edgar',
            'user_id' => '9'
        ]);

        Admin::create([ // 4
            'nama' => 'ghalbi yustiawan',
            'user_id' => '7'
        ]);

        Admin::create([ // 5
            'nama' => 'jessindy',
            'user_id' => '10'
        ]);

        Admin::create([ // 6
            'nama' => 'siti aulia',
            'user_id' => '8'
        ]);
    }
}