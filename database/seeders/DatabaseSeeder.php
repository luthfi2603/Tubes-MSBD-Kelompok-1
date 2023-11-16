<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'kelompok1',
            'email' => 'kelompok1@gmail.com',
            'password' => bcrypt('kelompok1')
        ]);

        /* User::create([
            'username' => 'ZeeroXc',
            'email' => 'luthfim904@gmail.com',
            'password' => bcrypt('password')
        ]);
        
        User::create([
            'username' => 'fortyche',
            'email' => 'rifqijabrah@gmail.com',
            'password' => bcrypt('password')
        ]); */

        $this->call(ProdisTableSeeder::class);
        $this->call(MahasiswasTableSeeder::class);
        $this->call(BidangIlmuTableSeeder::class);
        $this->call(JenisTulisanTableSeeder::class);
    }
}