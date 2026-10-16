@extends('layout.app')

@section('title', 'Tambah Prodi')

@section('content')
<div class="card card-primary">
    <form action="{{ route('prodi.store') }}" method="POST">
        @csrf
        @include('prodi._form')
    </form>
</div>
@endsection
