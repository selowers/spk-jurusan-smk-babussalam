<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KriteriaController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::resource('siswa', SiswaController::class);
Route::resource('kriteria', KriteriaController::class);
