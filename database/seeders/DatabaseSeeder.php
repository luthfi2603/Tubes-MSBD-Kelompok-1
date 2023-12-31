<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call(UsersTableSeeder::class);
        $this->call(ProdisTableSeeder::class);
        $this->call(MahasiswasTableSeeder::class);
        $this->call(DosenTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(BidangIlmuTableSeeder::class);
        $this->call(JenisTulisanTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(KaryaTulisTableSeeder::class);
        $this->call(KontributorMahasiswaTableSeeder::class);
        $this->call(KontributorDosenTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        $this->call(KataKuncisTableSeeder::class);
        $this->call(KataKunciTulisansTableSeeder::class);
        $this->call(EbooksTableSeeder::class);
    }
}