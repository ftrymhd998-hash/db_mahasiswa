@extends('layout.app')

@section('title', 'Edit KRS')

@section('content')
<div class="card card-warning">
    <form action="{{ route('krs.update', $krs) }}" method="POST">
        @csrf @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Mahasiswa</label>
                <input type="text" class="form-control" value="{{ $krs->mahasiswa->npm }} - {{ $krs->mahasiswa->nama_lengkap }}" disabled>
            </div>
            <div class="form-group">
                <label>Mata Kuliah</label>
                <input type="text" class="form-control" value="{{ $krs->mataKuliah->kode_mk }} - {{ $krs->mataKuliah->nama_mk }}" disabled>
            </div>

            <div class="form-group">
                <label for="semester">Semester</label>
                <input type="text" name="semester" id="semester"
                       class="form-control @error('semester') is-invalid @enderror" value="{{ old('semester', $krs->semester) }}">
                @error('semester') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="nilai">Nilai</label>
                <select name="nilai" id="nilai" class="form-control @error('nilai') is-invalid @enderror">
                    <option value="">-- Belum ada nilai --</option>
                    @foreach ($daftarNilai as $n)
                        <option value="{{ $n }}" {{ old('nilai', $krs->nilai) === $n ? 'selected' : '' }}>{{ $n }}</option>
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
