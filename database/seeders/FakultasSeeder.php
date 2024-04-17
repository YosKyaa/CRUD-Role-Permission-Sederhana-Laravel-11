<?php

namespace Database\Seeders;


use App\Models\Fakultas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fakultas::create([
            'kode_fakultas' => 'FTIK',
            'nama_fakultas' => 'Fakultas Teknik',
        ]);
        Fakultas::create([
            'kode_fakultas' => 'FEB',
            'nama_fakultas' => 'Fakultas Ekonomi dan Bisnis',
        ]);
        Fakultas::create([
            'kode_fakultas' => 'FF',
            'nama_fakultas' => 'Farmasi',
        ]);
    }
}
