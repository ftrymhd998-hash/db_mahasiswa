<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Prodi;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $jumlah = [
            'mahasiswa'  => Mahasiswa::count(),
            'prodi'      => Prodi::count(),
            'mataKuliah' => MataKuliah::count(),
            'krs'        => Krs::count(),
        ];
        $perProdi = Prodi::withCount('mahasiswa')->orderBy('nama_prodi')->get();
        $tanpaProdi = Mahasiswa::whereNull('prodi_id')->count();

        // Data untuk grafik (Chart.js)
        $labelProdi = $perProdi->pluck('nama_prodi')->all();
        $dataProdi = $perProdi->pluck('mahasiswa_count')->all();
        if ($tanpaProdi > 0) {
            $labelProdi[] = 'Belum memilih prodi';
            $dataProdi[] = $tanpaProdi;
        }

        $labelNilai = ['A', 'B', 'C', 'D', 'E', 'Belum ada nilai'];
        $dataNilai = [];
        foreach (['A', 'B', 'C', 'D', 'E'] as $n) {
            $dataNilai[] = Krs::where('nilai', $n)->count();
        }
        $dataNilai[] = Krs::whereNull('nilai')->count();

        $topMk = MataKuliah::withCount('mahasiswa')->orderByDesc('mahasiswa_count')->orderBy('kode_mk')->limit(10)->get();

        $chart = [
            'prodi' => ['labels' => $labelProdi, 'data' => $dataProdi],
            'nilai' => ['labels' => $labelNilai, 'data' => $dataNilai],
            'mk'    => ['labels' => $topMk->pluck('nama_mk')->all(), 'data' => $topMk->pluck('mahasiswa_count')->all()],
        ];

        return view('dashboard', compact('jumlah', 'perProdi', 'tanpaProdi', 'chart'));
    }

    public function about()
    {
        return view('about');
    }

    public function logout()
    {
        return 'Logout Berhasil';
    }
}
