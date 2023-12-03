<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Favorite;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Favorite::create([
            'user_id' => '4',
            'karya_id' => '1',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '2',
            'karya_id' => '1',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '5',
            'karya_id' => '1',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '4',
            'karya_id' => '2',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '2',
            'karya_id' => '2',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '5',
            'karya_id' => '2',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '4',
            'karya_id' => '3',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '2',
            'karya_id' => '3',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '5',
            'karya_id' => '3',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '4',
            'karya_id' => '4',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '2',
            'karya_id' => '4',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '5',
            'karya_id' => '4',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '4',
            'karya_id' => '5',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '2',
            'karya_id' => '5',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '5',
            'karya_id' => '5',
            // 'waktu' => Carbon::now()
        ]);
        Favorite::create([
            'user_id' => '5',
            'karya_id' => '6',
            // 'waktu' => Carbon::now()
        ]);
    }
}