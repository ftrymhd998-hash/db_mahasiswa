@extends('layout.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="card card-primary">
    <form action="{{ route('mata-kuliah.store') }}" method="POST">
        @csrf
        @include('mata_kuliah._form')
    </form>
</div>
@endsection
