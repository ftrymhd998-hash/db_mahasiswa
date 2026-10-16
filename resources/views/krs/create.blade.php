@extends('layout.app')

@section('title', 'Tambah KRS')

@section('content')
<div class="card card-primary">
    <form action="{{ route('krs.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="mahasiswa_id">Mahasiswa</label>
                <select name="mahasiswa_id" id="mahasiswa_id" class="form-control @error('mahasiswa_id') is-invalid @enderror">
                    <option value="">-- Pilih Mahasiswa --</option>
                    @foreach ($mahasiswa as $m)
                        <option value="{{ $m->id }}" {{ old('mahasiswa_id') == $m->id ? 'selected' : '' }}>{{ $m->npm }} - {{ $m->nama_lengkap }}</option>
                    @endforeach
                </select>
                @error('mahasiswa_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="mata_kuliah_id">Mata Kuliah</label>
                <select name="mata_kuliah_id" id="mata_kuliah_id" class="form-control @error('mata_kuliah_id') is-invalid @enderror">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach ($mataKuliah as $mk)
                        <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>{{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)</option>
                    @endforeach
                </select>
                @error('mata_kuliah_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="semester">Semester</label>
                <input type="text" name="semester" id="semester" placeholder="contoh: 2026/Ganjil"
                       class="form-control @error('semester') is-invalid @enderror" value="{{ old('semester') }}">
                @error('semester') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="nilai">Nilai (boleh dikosongkan)</label>
                <select name="nilai" id="nilai" class="form-control @error('nilai') is-invalid @enderror">
                    <option value="">-- Belum ada nilai --</option>
                    @foreach ($daftarNilai as $n)
                        <option value="{{ $n }}" {{ old('nilai') === $n ? 'selected' : '' }}>{{ $n }}</option>
                    @endforeach
                </select>
                @error('nilai') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('krs.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
