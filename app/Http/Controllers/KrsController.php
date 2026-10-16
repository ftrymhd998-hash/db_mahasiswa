<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KrsController extends Controller
{
    private const NILAI = ['A', 'B', 'C', 'D', 'E'];

    public function index()
    {
        $krs = Krs::with(['mahasiswa', 'mataKuliah'])->orderByDesc('id')->get();
        return view('krs.index', compact('krs'));
    }

    public function create()
    {
        return view('krs.create', [
            'mahasiswa'  => Mahasiswa::orderBy('npm')->get(),
            'mataKuliah' => MataKuliah::orderBy('kode_mk')->get(),
            'daftarNilai' => self::NILAI,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mahasiswa_id'   => ['required', 'exists:mahasiswa,id'],
            'mata_kuliah_id' => [
                'required', 'exists:mata_kuliah,id',
                Rule::unique('krs')->where(fn ($q) => $q
                    ->where('mahasiswa_id', $request->mahasiswa_id)
                    ->where('semester', $request->semester)),
            ],
            'semester' => ['required', 'max:50'],
            'nilai'    => ['nullable', Rule::in(self::NILAI)],
        ], $this->pesan() + ['mata_kuliah_id.unique' => 'Mahasiswa ini sudah mengambil mata kuliah tersebut pada semester yang sama.'], $this->namaKolom());

        Krs::create($data);

        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil ditambahkan.');
    }

    public function edit(Krs $krs)
    {
        $krs->load(['mahasiswa', 'mataKuliah']);

        return view('krs.edit', ['krs' => $krs, 'daftarNilai' => self::NILAI]);
    }

    public function update(Request $request, Krs $krs)
    {
        $data = $request->validate([
            'semester' => [
                'required', 'max:50',
                Rule::unique('krs')->where(fn ($q) => $q
                    ->where('mahasiswa_id', $krs->mahasiswa_id)
                    ->where('mata_kuliah_id', $krs->mata_kuliah_id))->ignore($krs->id),
            ],
            'nilai' => ['nullable', Rule::in(self::NILAI)],
        ], $this->pesan() + ['semester.unique' => 'Mahasiswa ini sudah mengambil mata kuliah tersebut pada semester yang sama.'], $this->namaKolom());

        $krs->update($data);

        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil diubah.');
    }

    public function destroy(Krs $krs)
    {
        $krs->delete();

        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil dihapus.');
    }
}
