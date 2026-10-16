@extends('layout.app')

@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="card card-warning">
    <form action="{{ route('mata-kuliah.update', $mataKuliah) }}" method="POST">
        @csrf @method('PUT')
        @include('mata_kuliah._form')
    </form>
</div>
@endsection
