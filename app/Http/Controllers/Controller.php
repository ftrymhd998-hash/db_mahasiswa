<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** Pesan validasi dalam bahasa Indonesia. */
    protected function pesan(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'unique'   => ':attribute sudah terdaftar.',
            'email'    => 'Format :attribute tidak valid.',
            'exists'   => ':attribute yang dipilih tidak valid.',
            'max'      => ':attribute maksimal :max karakter.',
            'integer'  => ':attribute harus berupa angka.',
            'min'      => ':attribute minimal :min.',
            'in'       => ':attribute yang dipilih tidak valid.',
            'regex'    => 'Format :attribute tidak valid.',
        ];
    }

    protected function namaKolom(): array
    {
        return [
            'npm' => 'NPM', 'nama_lengkap' => 'Nama lengkap', 'alamat' => 'Alamat',
            'email' => 'Email', 'telpon' => 'Telpon', 'prodi_id' => 'Prodi',
            'kode_prodi' => 'Kode prodi', 'nama_prodi' => 'Nama prodi',
            'kode_mk' => 'Kode MK', 'nama_mk' => 'Nama mata kuliah', 'sks' => 'SKS',
            'mahasiswa_id' => 'Mahasiswa', 'mata_kuliah_id' => 'Mata kuliah',
            'semester' => 'Semester', 'nilai' => 'Nilai',
        ];
    }
}
