<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DosenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dosen::create([
            'nidn' => '0031087905',
            'nip' => '197908312009121002',
            'nama' => 'Dedy Arisandi S.T., M.Kom.',
            'kode_dosen' => 'DDY',
            'jenis_kelamin' => 'L',
            'user_id' => '1',
            'kode_prodi' => '02',
        ]);
        Dosen::create([
            'nidn' => '0107078404',
            'nip' => '198407072015041001',
            'nama' => 'Ivan Jaya S.Si., M.Kom.',
            'kode_dosen' => 'IVJ',
            'jenis_kelamin' => 'L',
            'user_id' => '5',
            'kode_prodi' => '02',
        ]);
    }
}