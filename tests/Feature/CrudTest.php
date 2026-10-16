<?php

namespace Tests\Feature;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Prodi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrudTest extends TestCase
{
    use RefreshDatabase;

    private function mhs(array $o = []): Mahasiswa
    {
        return Mahasiswa::create($o + [
            'npm' => '2410010204', 'nama_lengkap' => 'Muhammad Fitri', 'alamat' => 'Martapura',
            'email' => 'fitri@example.com', 'telpon' => '081234567890',
        ]);
    }

    public function test_semua_halaman_bisa_dibuka()
    {
        $m = $this->mhs();
        $p = Prodi::create(['kode_prodi' => 'TI', 'nama_prodi' => 'Teknik Informatika']);
        $mk = MataKuliah::create(['kode_mk' => 'TI101', 'nama_mk' => 'Basis Data', 'sks' => 3]);
        $k = Krs::create(['mahasiswa_id' => $m->id, 'mata_kuliah_id' => $mk->id, 'semester' => '2026/Ganjil']);

        foreach ([
            '/dashboard', '/about', '/mahasiswa', '/mahasiswa/create', "/mahasiswa/{$m->id}/edit",
            '/prodi', '/prodi/create', "/prodi/{$p->id}/edit",
            '/mata-kuliah', '/mata-kuliah/create', "/mata-kuliah/{$mk->id}/edit",
            '/krs', '/krs/create', "/krs/{$k->id}/edit",
        ] as $url) {
            $this->get($url)->assertOk();
        }
        $this->get('/')->assertRedirect('/dashboard');
    }

    public function test_mahasiswa_crud_dan_validasi()
    {
        $p = Prodi::create(['kode_prodi' => 'TI', 'nama_prodi' => 'Teknik Informatika']);

        $this->post('/mahasiswa', [])->assertSessionHasErrors(['npm', 'nama_lengkap', 'alamat', 'email', 'telpon']);
        $this->post('/mahasiswa', ['npm' => '1', 'nama_lengkap' => 'A', 'alamat' => 'x', 'email' => 'salah', 'telpon' => 'abc'])
            ->assertSessionHasErrors(['email', 'telpon']);

        $data = ['prodi_id' => $p->id, 'npm' => '2410010570', 'nama_lengkap' => 'Ali Husin',
                 'alamat' => 'Banjarbaru', 'email' => 'ali@example.com', 'telpon' => '082345678901'];
        $this->post('/mahasiswa', $data)->assertRedirect('/mahasiswa');
        $this->assertDatabaseHas('mahasiswa', ['npm' => '2410010570', 'prodi_id' => $p->id]);

        // NPM harus unik
        $this->post('/mahasiswa', $data)->assertSessionHasErrors('npm');

        $m = Mahasiswa::first();
        // update tanpa mengubah NPM tidak boleh dianggap duplikat
        $this->put("/mahasiswa/{$m->id}", ['nama_lengkap' => 'Ali H.'] + $data)->assertRedirect('/mahasiswa');
        $this->assertDatabaseHas('mahasiswa', ['id' => $m->id, 'nama_lengkap' => 'Ali H.']);

        $this->delete("/mahasiswa/{$m->id}")->assertRedirect('/mahasiswa');
        $this->assertDatabaseMissing('mahasiswa', ['id' => $m->id]);
    }

    public function test_prodi_dan_mata_kuliah_crud()
    {
        $this->post('/prodi', ['kode_prodi' => 'SI', 'nama_prodi' => 'Sistem Informasi'])->assertRedirect('/prodi');
        $this->post('/prodi', ['kode_prodi' => 'SI', 'nama_prodi' => 'Lain'])->assertSessionHasErrors('kode_prodi');
        $p = Prodi::first();
        $this->put("/prodi/{$p->id}", ['kode_prodi' => 'SI', 'nama_prodi' => 'SI Baru'])->assertRedirect('/prodi');
        $this->assertDatabaseHas('prodi', ['nama_prodi' => 'SI Baru']);

        $this->post('/mata-kuliah', ['kode_mk' => 'TI101', 'nama_mk' => 'Basis Data', 'sks' => 3])->assertRedirect('/mata-kuliah');
        $this->post('/mata-kuliah', ['kode_mk' => 'X', 'nama_mk' => 'Y', 'sks' => 9])->assertSessionHasErrors('sks');
        $mk = MataKuliah::first();
        $this->put("/mata-kuliah/{$mk->id}", ['kode_mk' => 'TI101', 'nama_mk' => 'Basis Data 2', 'sks' => 4])->assertRedirect('/mata-kuliah');
        $this->assertDatabaseHas('mata_kuliah', ['nama_mk' => 'Basis Data 2', 'sks' => 4]);
        $this->delete("/mata-kuliah/{$mk->id}")->assertRedirect('/mata-kuliah');
        $this->assertDatabaseCount('mata_kuliah', 0);
    }

    public function test_hapus_prodi_membuat_mahasiswa_tanpa_prodi()
    {
        $p = Prodi::create(['kode_prodi' => 'TI', 'nama_prodi' => 'Teknik Informatika']);
        $m = $this->mhs(['prodi_id' => $p->id]);

        $this->delete("/prodi/{$p->id}")->assertRedirect('/prodi');
        $this->assertNull($m->fresh()->prodi_id);
        $this->assertDatabaseHas('mahasiswa', ['id' => $m->id]);
    }

    public function test_krs_crud_duplikat_dan_cascade()
    {
        $m = $this->mhs();
        $mk = MataKuliah::create(['kode_mk' => 'TI101', 'nama_mk' => 'Basis Data', 'sks' => 3]);
        $data = ['mahasiswa_id' => $m->id, 'mata_kuliah_id' => $mk->id, 'semester' => '2026/Ganjil', 'nilai' => 'A'];

        $this->post('/krs', [])->assertSessionHasErrors(['mahasiswa_id', 'mata_kuliah_id', 'semester']);
        $this->post('/krs', $data)->assertRedirect('/krs');
        $this->post('/krs', $data)->assertSessionHasErrors('mata_kuliah_id');            // duplikat ditolak
        $this->post('/krs', ['semester' => '2026/Genap'] + $data)->assertRedirect('/krs'); // semester lain boleh
        $this->post('/krs', ['nilai' => 'Z', 'semester' => '2027/Ganjil'] + $data)->assertSessionHasErrors('nilai');

        $k = Krs::where('semester', '2026/Ganjil')->first();
        $this->put("/krs/{$k->id}", ['semester' => '2026/Ganjil', 'nilai' => 'B'])->assertRedirect('/krs');
        $this->assertDatabaseHas('krs', ['id' => $k->id, 'nilai' => 'B']);
        $this->put("/krs/{$k->id}", ['semester' => '2026/Genap', 'nilai' => 'B'])->assertSessionHasErrors('semester'); // bentrok

        $this->delete("/mahasiswa/{$m->id}");
        $this->assertDatabaseCount('krs', 0);                                              // cascade
    }

    public function test_relasi_many_to_many()
    {
        $m = $this->mhs();
        $mk = MataKuliah::create(['kode_mk' => 'TI101', 'nama_mk' => 'Basis Data', 'sks' => 3]);
        $m->mataKuliah()->attach($mk->id, ['semester' => '2026/Ganjil', 'nilai' => 'A']);

        $this->assertEquals('A', $m->mataKuliah->first()->pivot->nilai);
        $this->assertEquals($m->id, $mk->mahasiswa->first()->id);
    }

    public function test_dashboard_menampilkan_data_grafik()
    {
        $this->get('/dashboard')->assertOk()->assertSee('Belum ada data KRS.');   // kosong

        $p = Prodi::create(['kode_prodi' => 'TI', 'nama_prodi' => 'Teknik Informatika']);
        $m = $this->mhs(['prodi_id' => $p->id]);
        $mk = MataKuliah::create(['kode_mk' => 'TI101', 'nama_mk' => 'Basis Data', 'sks' => 3]);
        Krs::create(['mahasiswa_id' => $m->id, 'mata_kuliah_id' => $mk->id, 'semester' => '2026/Ganjil', 'nilai' => 'A']);

        $r = $this->get('/dashboard')->assertOk();
        $r->assertSee('chartProdi', false)->assertSee('chartNilai', false)->assertSee('chartMk', false);
        $r->assertViewHas('chart', function ($c) {
            return $c['prodi']['data'] === [1]
                && $c['nilai']['data'] === [1, 0, 0, 0, 0, 0]
                && $c['mk']['labels'] === ['Basis Data'] && $c['mk']['data'] === [1];
        });
    }
}
