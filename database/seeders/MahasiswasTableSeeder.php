<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'nim' => '171402050',
            'nama' => 'Muhammad Luthfi',
            'angkatan' => '2017',
            'jenis_kelamin' => 'L',
            'status' => 'lulus',
            'user_id' => '4',
            'kode_prodi' => '02'
        ]);
        
        Mahasiswa::create([
            'nim' => '221402031',
            'nama' => 'Rifqi Jabrah Rhae',
            'angkatan' => '2022',
            'jenis_kelamin' => 'L',
            'status' => 'aktif',
            'user_id' => '6',
            'kode_prodi' => '02'
        ]);
        
        Mahasiswa::create([
            'nim' => '151402053',
            'nama' => 'Andy Septiawan Saragih',
            'angkatan' => '2015',
            'jenis_kelamin' => 'L',
            'status' => 'lulus',
            'user_id' => '1',
            'kode_prodi' => '02'
        ]);
        
        Mahasiswa::create([
            'nim' => '221402106',
            'nama' => 'Ivan Mulatua Tambunan',
            'angkatan' => '2022',
            'jenis_kelamin' => 'L',
            'status' => 'aktif',
            'user_id' => '1',
            'kode_prodi' => '02'
        ]);
        
        Mahasiswa::create([
            'nim' => '181402015',
            'nama' => 'Ruth Grace Manurung',
            'angkatan' => '2018',
            'jenis_kelamin' => 'P',
            'status' => 'lulus',
            'user_id' => '1',
            'kode_prodi' => '02'
        ]);
        
        Mahasiswa::create([
            'nim' => '221402068',
            'nama' => 'Najwa Amanda',
            'angkatan' => '2022',
            'jenis_kelamin' => 'P',
            'status' => 'aktif',
            'user_id' => '1',
            'kode_prodi' => '02'
        ]);
        
        Mahasiswa::create([
            'nim' => '221402021',
            'nama' => 'Frengky Saputra',
            'angkatan' => '2022',
            'jenis_kelamin' => 'L',
            'status' => 'aktif',
            'user_id' => '1',
            'kode_prodi' => '02'
        ]);
        
        Mahasiswa::create([
            'nim' => '221401001',
            'nama' => 'Unknown User 1',
            'angkatan' => '2022',
            'jenis_kelamin' => 'L',
            'status' => 'aktif',
            'user_id' => '1',
            'kode_prodi' => '01'
        ]);

        Mahasiswa::create([
            'nim' => '221401032',
            'nama' => 'RIO OCTAVIANNUS LOKA',
            'angkatan' => '2022',
            'jenis_kelamin' => 'L',
            'status' => 'aktif',
            'user_id' => '1',
            'kode_prodi' => '01'
        ]);

        Mahasiswa::create([
            'nim' => '181401016',
            'nama' => 'JOHANES INGANTA KARO-KARO',
            'angkatan' => '2018',
            'jenis_kelamin' => 'L',
            'status' => 'lulus',
            'user_id' => '1',
            'kode_prodi' => '01'
        ]);
        Mahasiswa::create([
            'nim' => '181403014',
            'nama' => 'Mustafa Kamal',
            'angkatan' => '2018',
            'jenis_kelamin' => 'L',
            'status' => 'lulus',
            'user_id' => '1',
            'kode_prodi' => '03'
        ]);
        Mahasiswa::create([
            'nim' => '181404023',
            'nama' => 'Jamilah Hasibuan',
            'angkatan' => '2018',
            'jenis_kelamin' => 'P',
            'status' => 'lulus',
            'user_id' => '1',
            'kode_prodi' => '04'
        ]);
        Mahasiswa::create([
            'nim' => '181405001',
            'nama' => 'Mahatma Lincoln',
            'angkatan' => '2018',
            'jenis_kelamin' => 'L',
            'status' => 'lulus',
            'user_id' => '1',
            'kode_prodi' => '05'
        ]);
    }
}