<?php

namespace Database\Seeders;

use App\Models\Ebook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EbooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ebook::create([
            'judul' => 'Buku Hijau',
            'penulis' => 'Oracle',
            'tahun_terbit' => '2050',
            'view' => '0',
            'url_file' => 'document/data-dummy-karya-tulis.pdf',
            'diupload_oleh' => 'admin'
        ]);
        
        Ebook::create([
            'judul' => 'Buku Biru',
            'penulis' => 'Word',
            'tahun_terbit' => '2055',
            'view' => '0',
            'url_file' => 'document/data-dummy-karya-tulis.pdf',
            'diupload_oleh' => 'admin'
        ]);
    }
}