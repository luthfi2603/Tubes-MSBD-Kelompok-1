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
            'judul' => 'Pengenalan Database Oracle',
            'penulis' => 'Oracle',
            'tahun_terbit' => '2020',
            'view' => '0',
            'url_file' => 'document/data-dummy-karya-tulis.pdf',
            'diupload_oleh' => 'admin'
        ]);
        
        Ebook::create([
            'judul' => 'Dasar Dasar Microsoft Word',
            'penulis' => 'Word',
            'tahun_terbit' => '2010',
            'view' => '0',
            'url_file' => 'document/data-dummy-karya-tulis.pdf',
            'diupload_oleh' => 'admin'
        ]);

        Ebook::create([
            'judul' => 'Dasar Dasar Microsoft Excel',
            'penulis' => 'Word',
            'tahun_terbit' => '2015',
            'view' => '0',
            'url_file' => 'document/data-dummy-karya-tulis.pdf',
            'diupload_oleh' => 'admin'
        ]);

        Ebook::create([
            'judul' => 'Pengenalan Virtual dan Augmented Reality',
            'penulis' => 'Mixed Reality',
            'tahun_terbit' => '2055',
            'view' => '0',
            'url_file' => 'document/data-dummy-karya-tulis.pdf',
            'diupload_oleh' => 'admin'
        ]);

        Ebook::create([
            'judul' => 'Algorithms and Data Structure',
            'penulis' => 'Jurg Nievergelt and Klaus H.',
            'tahun_terbit' => '1993',
            'view' => '0',
            'url_file' => 'document/data-dummy-karya-tulis.pdf',
            'diupload_oleh' => 'admin'
        ]);

        Ebook::create([
            'judul' => 'An Introduction to object oriented programming',
            'penulis' => 'Timothy Budd',
            'tahun_terbit' => '1991',
            'view' => '0',
            'url_file' => 'document/data-dummy-karya-tulis.pdf',
            'diupload_oleh' => 'admin'
        ]);

        Ebook::create([
            'judul' => 'Numerical mathematics and computing',
            'penulis' => 'Ward Cheney and David Kincaid',
            'tahun_terbit' => '2013',
            'view' => '0',
            'url_file' => 'document/data-dummy-karya-tulis.pdf',
            'diupload_oleh' => 'admin'
        ]);

        Ebook::create([
            'judul' => 'Fundamentals of computer architecture and design',
            'penulis' => 'Ahmed Binda',
            'tahun_terbit' => '2017',
            'view' => '0',
            'url_file' => 'document/data-dummy-karya-tulis.pdf',
            'diupload_oleh' => 'admin'
        ]);

        Ebook::create([
            'judul' => 'Database modeling and design : logical design',
            'penulis' => 'Toby Teorey, Sam Lighstone, Tom Nadeau, and H.V. Jagadish',
            'tahun_terbit' => '2011',
            'view' => '0',
            'url_file' => 'document/data-dummy-karya-tulis.pdf',
            'diupload_oleh' => 'admin'
        ]);

        Ebook::create([
            'judul' => 'Software engineering',
            'penulis' => 'Rudy Rucker',
            'tahun_terbit' => '2003',
            'view' => '0',
            'url_file' => 'document/data-dummy-karya-tulis.pdf',
            'diupload_oleh' => 'admin'
        ]);
    }
}