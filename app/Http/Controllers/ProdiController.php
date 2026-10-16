<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::withCount('mahasiswa')->orderBy('kode_prodi')->get();
        return view('prodi.index', compact('prodi'));
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        Prodi::create($this->validasi($request));

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil ditambahkan.');
    }

    public function edit(Prodi $prodi)
    {
        return view('prodi.edit', compact('prodi'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $prodi->update($this->validasi($request, $prodi));

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil diubah.');
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus. Mahasiswa pada prodi ini menjadi tanpa prodi.');
    }

    private function validasi(Request $request, ?Prodi $prodi = null): array
    {
        return $request->validate([
            'kode_prodi' => ['required', 'max:20', Rule::unique('prodi', 'kode_prodi')->ignore($prodi?->id)],
            'nama_prodi' => ['required', 'max:100'],
        ], $this->pesan(), $this->namaKolom());
    }
}
