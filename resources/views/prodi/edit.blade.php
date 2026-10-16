@extends('layout.app')

@section('title', 'Edit Prodi')

@section('content')
<div class="card card-warning">
    <form action="{{ route('prodi.update', $prodi) }}" method="POST">
        @csrf @method('PUT')
        @include('prodi._form')
    </form>
</div>
@endsection
