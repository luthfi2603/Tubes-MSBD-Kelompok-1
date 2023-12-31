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
            'user_id' => '11',
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
        Dosen::create([
            'nidn' => '0024109003',
            'nip' => '199110242020122020',
            'nama' => 'Maulida Yanti S.Si., M.Si.',
            'kode_dosen' => 'MLY',
            'jenis_kelamin' => 'P',
            'user_id' => '1',
            'kode_prodi' => '02',
        ]);
        Dosen::create([
            'nidn' => '0119098902',
            'nip' => '198909192018051001',
            'nama' => 'Niskarto Zendrato S.Kom., M.Kom.',
            'kode_dosen' => 'NSK',
            'jenis_kelamin' => 'L',
            'user_id' => '1',
            'kode_prodi' => '02',
        ]);
        Dosen::create([
            'nidn' => '0011049114',
            'nip' => '199104112021022001',
            'nama' => 'Umaya Ramadhani Putri Nasution S.TI., M.Kom.',
            'kode_dosen' => 'UMY',
            'jenis_kelamin' => 'P',
            'user_id' => '1',
            'kode_prodi' => '02',
        ]);
        Dosen::create([
            'nidn' => '0009089301',
            'nip' => '199308092020012001',
            'nama' => 'Annisa Fadhillah Pulungan S.Kom., M.Kom.',
            'kode_dosen' => 'ANN',
            'jenis_kelamin' => 'P',
            'user_id' => '1',
            'kode_prodi' => '02',
        ]);
        Dosen::create([
            'nidn' => '0010116706',
            'nip' => '196711101996021001',
            'nama' => 'Prof. Dr. Syahril Efendi S.Si., M.I.T.',
            'kode_dosen' => 'SYH',
            'jenis_kelamin' => 'L',
            'user_id' => '1',
            'kode_prodi' => '05',
        ]);
        Dosen::create([
            'nidn' => '0008017906',
            'nip' => '197901082012121002',
            'nama' => 'Baihaqi Siregar S.Si., M.T.',
            'kode_dosen' => 'BHQ',
            'jenis_kelamin' => 'L',
            'user_id' => '1',
            'kode_prodi' => '04',
        ]);
        Dosen::create([
            'nidn' => '0004097901',
            'nip' => '197909042009121002',
            'nama' => 'Dr. Eng Ade Candra S.T., M.Kom.',
            'kode_dosen' => 'ADC',
            'jenis_kelamin' => 'L',
            'user_id' => '1',
            'kode_prodi' => '03',
        ]);
        Dosen::create([
            'nidn' => '0101058801',
            'nip' => '198805012015042006',
            'nama' => 'Sri Melvani Hardi S.Kom., M.Kom.',
            'kode_dosen' => 'MLV',
            'jenis_kelamin' => 'P',
            'user_id' => '1',
            'kode_prodi' => '01',
        ]);
    }
}