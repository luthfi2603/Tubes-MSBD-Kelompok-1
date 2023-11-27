<?php

namespace Database\Seeders;

use App\Models\KaryaTulis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryaTulisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KaryaTulis::create([
            'judul' => 'skripsi',
            'abstrak' => 'skripsi',
            'bidang_ilmu' => 'Machine Learning',
            'url_file' => 'skripsi.pdf',
            'jenis' => 'Skripsi',
            'tahun' => '2020',
            'view' => '0',
            'diupload_oleh' => 'skripsi', 
        ]);
        KaryaTulis::create([
            'judul' => 'disertasi',
            'abstrak' => 'disertasi',
            'bidang_ilmu' => 'AI',
            'url_file' => 'disertasi.pdf',
            'jenis' => 'Disertasi',
            'tahun' => '2022',
            'view' => '0',
            'diupload_oleh' => 'disertasi', 
        ]);
        KaryaTulis::create([
            'judul' => 'tesis',
            'abstrak' => 'tesis',
            'bidang_ilmu' => 'Data Science',
            'url_file' => 'tesis.pdf',
            'jenis' => 'Tesis',
            'tahun' => '2020',
            'view' => '0',
            'diupload_oleh' => 'tesis', 
        ]);

        KaryaTulis::create([
            'judul' => 'jurnal',
            'abstrak' => 'jurnal',
            'bidang_ilmu' => 'IoT',
            'url_file' => 'jurnal.pdf',
            'jenis' => 'Jurnal',
            'tahun' => '2023',
            'view' => '0',
            'diupload_oleh' => 'jurnal', 
        ]);
        KaryaTulis::create([
            'judul' => 'karya ilmiah',
            'abstrak' => 'karya ilmiah',
            'bidang_ilmu' => 'Data Science',
            'url_file' => 'karya_ilmiah.pdf',
            'jenis' => 'Karya Ilmiah',
            'tahun' => '2020',
            'view' => '0',
            'diupload_oleh' => 'karya ilmiah', 
        ]);
    }
}
