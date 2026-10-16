<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ProdiController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard']);
Route::get('/about', [DashboardController::class, 'about']);
Route::get('/logout', [DashboardController::class, 'logout']);

Route::resource('mahasiswa', MahasiswaController::class)->except('show');
Route::resource('prodi', ProdiController::class)->except('show');
Route::resource('mata-kuliah', MataKuliahController::class)
    ->except('show')
    ->parameters(['mata-kuliah' => 'mata_kuliah']);
Route::resource('krs', KrsController::class)
    ->except('show')
    ->parameters(['krs' => 'krs']);
