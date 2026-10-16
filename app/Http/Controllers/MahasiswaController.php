<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('prodi')->orderBy('npm')->get();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create', ['prodi' => Prodi::orderBy('nama_prodi')->get()]);
    }

    public function store(Request $request)
    {
        Mahasiswa::create($this->validasi($request));

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', [
            'mahasiswa' => $mahasiswa,
            'prodi'     => Prodi::orderBy('nama_prodi')->get(),
        ]);
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->update($this->validasi($request, $mahasiswa));

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diubah.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    private function validasi(Request $request, ?Mahasiswa $mahasiswa = null): array
    {
        return $request->validate([
            'prodi_id'     => ['nullable', 'exists:prodi,id'],
            'npm'          => ['required', 'max:20', Rule::unique('mahasiswa', 'npm')->ignore($mahasiswa?->id)],
            'nama_lengkap' => ['required', 'max:100'],
            'alamat'       => ['required'],
            'email'        => ['required', 'email', 'max:100'],
            'telpon'       => ['required', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
        ], $this->pesan(), $this->namaKolom());
    }
}
