<?php

namespace Database\Seeders;
use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Prodi::create([
            'kode_prodi' => 'TI',
            'fakultas_id' => 1,
            'nama_prodi' => 'Teknik Informatika',
        ]);
        Prodi::create([
            'kode_prodi' => 'TS',
            'fakultas_id' => 1,
            'nama_prodi' => 'Teknik Sipil',
        ]);
        Prodi::create([
            'kode_prodi' => 'TM',
            'fakultas_id' => 1,
            'nama_prodi' => 'Teknik Mesin',
        ]);
        Prodi::create([
            'kode_prodi' => 'TE',
            'fakultas_id' => 1,
            'nama_prodi' => 'Teknik Elektro',
        ]);
        Prodi::create([
            'kode_prodi' => 'TII',
            'fakultas_id' => 1,
            'nama_prodi' => 'Teknik Industri',
        ]);
        Prodi::create([
            'kode_prodi' => 'MM',
            'fakultas_id' => 2,
            'nama_prodi' => 'Management',
        ]);
        Prodi::create([
            'kode_prodi' => 'AK',
            'fakultas_id' => 2,
            'nama_prodi' => 'Akutansi',
        ]);
        Prodi::create([
            'kode_prodi' => 'BD',
            'fakultas_id' => 2,
            'nama_prodi' => 'Bisnis Digital',
        ]);
        Prodi::create([
            'kode_prodi' => 'F',
            'fakultas_id' => 3,
            'nama_prodi' => 'Farmasi',
        ]);
    }
}
