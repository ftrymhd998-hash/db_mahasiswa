<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Prodi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Prodi::firstOrCreate(['kode_prodi' => 'TI'], ['nama_prodi' => 'Teknik Informatika']);
        Prodi::firstOrCreate(['kode_prodi' => 'SI'], ['nama_prodi' => 'Sistem Informasi']);

        MataKuliah::firstOrCreate(['kode_mk' => 'TI101'], ['nama_mk' => 'Basis Data', 'sks' => 3]);
        MataKuliah::firstOrCreate(['kode_mk' => 'TI102'], ['nama_mk' => 'Pemrograman Web', 'sks' => 3]);

        Mahasiswa::firstOrCreate(['npm' => '2410010204'], [
            'nama_lengkap' => 'Muhammad Fitri', 'alamat' => 'Martapura',
            'email' => 'fitri999@gmail.com', 'telpon' => '081234567890',
        ]);
        Mahasiswa::firstOrCreate(['npm' => '2410010570'], [
            'nama_lengkap' => 'Ali Husin', 'alamat' => 'Banjarbaru',
            'email' => 'Ali@gmail.com', 'telpon' => '082345678901',
        ]);
    }
}
