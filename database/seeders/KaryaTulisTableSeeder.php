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
        KaryaTulis::create([ // 1
            'judul' => 'Peran Teknologi Blockchain dalam Keamanan Data',
            'abstrak' => 'Eu id et in aute. Do nulla occaecat elit dolor eu sunt do esse mollit enim sunt dolor cillum enim. Mollit nulla proident proident cillum. Exercitation fugiat magna aute excepteur. Duis non ea ullamco magna proident mollit incididunt sunt cillum aliquip laboris pariatur sit. Mollit amet ex elit anim proident eu sint.',
            'bidang_ilmu' => 'Machine Learning',
            'url_file' => 'skripsi.pdf',
            'jenis' => 'Skripsi',
            'tahun' => '2020',
            'view' => '93',
            'diupload_oleh' => 'Pak Andri'
        ]);
        KaryaTulis::create([ // 2
            'judul' => 'Analisis Mendalam: Strategi Pengelolaan Big Data untuk Keperluan Data Science',
            'abstrak' => 'Consequat labore magna pariatur aliqua pariatur eu non id in laboris mollit fugiat. Fugiat aute occaecat pariatur mollit ut enim ipsum ex est aliqua tempor. Veniam aute proident voluptate dolor deserunt culpa velit labore incididunt voluptate. Officia elit consequat id commodo aliquip aute ipsum magna reprehenderit. Tempor proident consectetur fugiat ipsum veniam veniam esse laborum duis elit elit nulla esse.',
            'bidang_ilmu' => 'Data Science',
            'url_file' => 'disertasi.pdf',
            'jenis' => 'Disertasi',
            'tahun' => '2022',
            'view' => '84',
            'diupload_oleh' => 'Pak Andri'
        ]);
        KaryaTulis::create([ // 3
            'judul' => 'Eksplorasi Aplikasi Kecerdasan Buatan dalam Pengembangan Sistem Otomatisasi',
            'abstrak' => 'Nostrud nisi ex pariatur proident tempor sint deserunt irure ex nulla. Ea aute exercitation velit enim velit aliqua veniam eiusmod minim excepteur. Reprehenderit anim elit amet occaecat est officia fugiat laboris anim aliqua eu exercitation. Ea ut aliqua ex commodo tempor sunt velit incididunt id occaecat cillum. Fugiat mollit incididunt laborum nulla.',
            'bidang_ilmu' => 'AI',
            'url_file' => 'tesis.pdf',
            'jenis' => 'Tesis',
            'tahun' => '2020',
            'view' => '72',
            'diupload_oleh' => 'Maia Cibebe'
        ]);

        KaryaTulis::create([ // 4
            'judul' => 'Integrasi IoT dalam Meningkatkan Efisiensi Sistem Pengelolaan Energi',
            'abstrak' => 'Aliquip consequat commodo eiusmod laboris minim voluptate dolore excepteur. Cupidatat laboris labore sit commodo consequat culpa excepteur. Laboris ad et irure magna. Mollit elit est voluptate proident mollit. Occaecat labore sint consectetur excepteur ut officia laborum sit sint laborum aliqua minim.',
            'bidang_ilmu' => 'IoT',
            'url_file' => 'jurnal.pdf',
            'jenis' => 'Jurnal',
            'tahun' => '2023',
            'view' => '52',
            'diupload_oleh' => 'Pak Andri'
        ]);
        KaryaTulis::create([ // 5
            'judul' => 'Pemanfaatan Teknologi VR dalam Industri Hiburan dan Pendidikan',
            'abstrak' => 'Veniam incididunt nulla aliquip fugiat aliquip adipisicing Lorem elit officia dolore occaecat anim. Consectetur duis pariatur aliqua incididunt nisi. Sit in enim reprehenderit laboris culpa in. Sit culpa eiusmod et Lorem dolor ex aliquip id. Irure voluptate ex ea labore sunt. Labore incididunt reprehenderit quis aute sint id eu. Excepteur culpa proident esse do est excepteur irure culpa consequat nostrud minim velit laboris.',
            'bidang_ilmu' => 'VR',
            'url_file' => 'karya_ilmiah.pdf',
            'jenis' => 'Karya Ilmiah',
            'tahun' => '2020',
            'view' => '93',
            'diupload_oleh' => 'Maia Cibebe'
        ]);
        KaryaTulis::create([ // 6
            'judul' => 'Apakah kita dapat membuat sesuatu dari kehampaan?',
            'abstrak' => 'Veniam incididunt nulla aliquip fugiat aliquip adipisicing Lorem elit officia dolore occaecat anim. Consectetur duis pariatur aliqua incididunt nisi. Sit in enim reprehenderit laboris culpa in. Sit culpa eiusmod et Lorem dolor ex aliquip id. Irure voluptate ex ea labore sunt. Labore incididunt reprehenderit quis aute sint id eu. Excepteur culpa proident esse do est excepteur irure culpa consequat nostrud minim velit laboris.',
            'bidang_ilmu' => 'Data Science',
            'url_file' => 'renkinjutsu.pdf',
            'jenis' => 'Karya Ilmiah',
            'tahun' => '2075',
            'view' => '1324',
            'diupload_oleh' => 'Maia Cibebe'
        ]);
        KaryaTulis::create([ // 7
            'judul' => 'Dinamika Perkembangan AI: Tantangan dan Peluang di Era Digital',
            'abstrak' => 'Ipsum laborum magna ea culpa amet officia cillum laboris Lorem reprehenderit. Ullamco labore consectetur quis eiusmod sint ad officia eu. Ad adipisicing eiusmod nostrud occaecat id Lorem tempor Lorem incididunt Lorem minim. Excepteur laboris velit quis ipsum anim nisi proident reprehenderit pariatur. Dolor tempor ullamco magna eu exercitation. Ex dolor tempor dolore adipisicing aliquip adipisicing.',
            'bidang_ilmu' => 'AI',
            'url_file' => 'tantangan-ai.pdf',
            'jenis' => 'Disertasi',
            'tahun' => '2022',
            'view' => '135',
            'diupload_oleh' => 'Pak Andri'
        ]);
    }
}