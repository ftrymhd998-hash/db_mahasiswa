@extends('layout.app')

@section('title', 'Data Mahasiswa')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Mahasiswa</h3>
        <div class="card-tools">
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Mahasiswa</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>No</th><th>NPM</th><th>Prodi</th><th>Nama Lengkap</th>
                    <th>Alamat</th><th>Email</th><th>Telpon</th><th style="width:150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $mhs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mhs->npm }}</td>
                    <td>{{ $mhs->prodi->nama_prodi ?? '-' }}</td>
                    <td>{{ $mhs->nama_lengkap }}</td>
                    <td>{{ $mhs->alamat }}</td>
                    <td>{{ $mhs->email }}</td>
                    <td>{{ $mhs->telpon }}</td>
                    <td>
                        <a href="{{ route('mahasiswa.edit', $mhs) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('mahasiswa.destroy', $mhs) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus mahasiswa {{ $mhs->nama_lengkap }}?')">
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
