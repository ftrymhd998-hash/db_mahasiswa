@extends('layout.app')

@section('title', 'Data Mata Kuliah')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Mata Kuliah</h3>
        <div class="card-tools">
            <a href="{{ route('mata-kuliah.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Mata Kuliah</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr><th>No</th><th>Kode MK</th><th>Nama Mata Kuliah</th><th>SKS</th><th style="width:150px">Aksi</th></tr>
            </thead>
            <tbody>
                @foreach ($mataKuliah as $mk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mk->kode_mk }}</td>
                    <td>{{ $mk->nama_mk }}</td>
                    <td>{{ $mk->sks }}</td>
                    <td>
                        <a href="{{ route('mata-kuliah.edit', $mk) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('mata-kuliah.destroy', $mk) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus mata kuliah {{ $mk->nama_mk }}? Data KRS terkait ikut terhapus.')">
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
