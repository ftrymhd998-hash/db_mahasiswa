@extends('layout.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="card card-primary">
    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf
        @include('mahasiswa._form')
    </form>
</div>
@endsection
