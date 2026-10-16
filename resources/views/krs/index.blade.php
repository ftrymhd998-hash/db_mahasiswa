@extends('layout.app')

@section('title', 'Data KRS')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Kartu Rencana Studi (KRS)</h3>
        <div class="card-tools">
            <a href="{{ route('krs.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah KRS</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>No</th><th>NPM</th><th>Nama Mahasiswa</th><th>Mata Kuliah</th>
                    <th>SKS</th><th>Semester</th><th>Nilai</th><th style="width:150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($krs as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->mahasiswa->npm }}</td>
                    <td>{{ $k->mahasiswa->nama_lengkap }}</td>
                    <td>{{ $k->mataKuliah->kode_mk }} - {{ $k->mataKuliah->nama_mk }}</td>
                    <td>{{ $k->mataKuliah->sks }}</td>
                    <td>{{ $k->semester }}</td>
                    <td>{{ $k->nilai ?? '-' }}</td>
                    <td>
                        <a href="{{ route('krs.edit', $k) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('krs.destroy', $k) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus data KRS ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
