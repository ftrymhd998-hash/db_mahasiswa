<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::orderBy('kode_mk')->get();
        return view('mata_kuliah.index', compact('mataKuliah'));
    }

    public function create()
    {
        return view('mata_kuliah.create');
    }

    public function store(Request $request)
    {
        MataKuliah::create($this->validasi($request));

        return redirect()->route('mata-kuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $mata_kuliah)
    {
        return view('mata_kuliah.edit', ['mataKuliah' => $mata_kuliah]);
    }

    public function update(Request $request, MataKuliah $mata_kuliah)
    {
        $mata_kuliah->update($this->validasi($request, $mata_kuliah));

        return redirect()->route('mata-kuliah.index')->with('success', 'Mata kuliah berhasil diubah.');
    }

    public function destroy(MataKuliah $mata_kuliah)
    {
        $mata_kuliah->delete();

        return redirect()->route('mata-kuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }

    private function validasi(Request $request, ?MataKuliah $mataKuliah = null): array
    {
        return $request->validate([
            'kode_mk' => ['required', 'max:20', Rule::unique('mata_kuliah', 'kode_mk')->ignore($mataKuliah?->id)],
            'nama_mk' => ['required', 'max:100'],
            'sks'     => ['required', 'integer', 'min:1', 'max:6'],
        ], $this->pesan(), $this->namaKolom());
    }
}
