@extends('layout.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="card card-warning">
    <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="POST">
        @csrf @method('PUT')
        @include('mahasiswa._form')
    </form>
</div>
@endsection
