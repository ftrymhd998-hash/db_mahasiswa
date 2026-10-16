@extends('layout.app')

@section('title', 'Data Prodi')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Program Studi</h3>
        <div class="card-tools">
            <a href="{{ route('prodi.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Prodi</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr><th>No</th><th>Kode</th><th>Nama Prodi</th><th>Jumlah Mahasiswa</th><th style="width:150px">Aksi</th></tr>
            </thead>
            <tbody>
                @foreach ($prodi as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->kode_prodi }}</td>
                    <td>{{ $p->nama_prodi }}</td>
                    <td>{{ $p->mahasiswa_count }}</td>
                    <td>
                        <a href="{{ route('prodi.edit', $p) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('prodi.destroy', $p) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus prodi {{ $p->nama_prodi }}? Mahasiswanya akan menjadi tanpa prodi.')">
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
