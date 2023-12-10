<?php

namespace Database\Seeders;

use App\Models\KataKunciTulisan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KataKunciTulisansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KataKunciTulisan::create([
            'karya_id' => '1',
            'kata_kunci' => 'Web'
        ]);
        KataKunciTulisan::create([
            'karya_id' => '1',
            'kata_kunci' => 'Kucing'
        ]);
        KataKunciTulisan::create([
            'karya_id' => '1',
            'kata_kunci' => 'Kambing'
        ]);
        
        KataKunciTulisan::create([
            'karya_id' => '2',
            'kata_kunci' => 'Database'
        ]);
        KataKunciTulisan::create([
            'karya_id' => '2',
            'kata_kunci' => 'Ayam'
        ]);
        KataKunciTulisan::create([
            'karya_id' => '2',
            'kata_kunci' => 'Ular'
        ]);
        
        KataKunciTulisan::create([
            'karya_id' => '3',
            'kata_kunci' => 'Kambing'
        ]);
        KataKunciTulisan::create([
            'karya_id' => '3',
            'kata_kunci' => 'Ular'
        ]);
        
        KataKunciTulisan::create([
            'karya_id' => '4',
            'kata_kunci' => 'Ayam'
        ]);
        KataKunciTulisan::create([
            'karya_id' => '4',
            'kata_kunci' => 'Ular'
        ]);
        
        KataKunciTulisan::create([
            'karya_id' => '5',
            'kata_kunci' => 'Database'
        ]);
        KataKunciTulisan::create([
            'karya_id' => '5',
            'kata_kunci' => 'Web'
        ]);
        KataKunciTulisan::create([
            'karya_id' => '5',
            'kata_kunci' => 'Kucing'
        ]);
        KataKunciTulisan::create([
            'karya_id' => '6',
            'kata_kunci' => 'Sihir'
        ]);
        KataKunciTulisan::create([
            'karya_id' => '6',
            'kata_kunci' => 'Database'
        ]);
        KataKunciTulisan::create([
            'karya_id' => '7',
            'kata_kunci' => 'Ular'
        ]);
        KataKunciTulisan::create([
            'karya_id' => '8',
            'kata_kunci' => 'Ayam'
        ]);
    }
}