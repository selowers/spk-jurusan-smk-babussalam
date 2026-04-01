<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\JurusanController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::resource('siswa', SiswaController::class);
Route::resource('kriteria', KriteriaController::class);
Route::resource('jurusan', JurusanController::class);
Route::post('jurusan/add-fakultas', [JurusanController::class, 'addFakultas'])->name('jurusan.addFakultas');
Route::post('jurusan/add-perguruan-tinggi', [JurusanController::class, 'addPerguruanTinggi'])->name('jurusan.addPerguruanTinggi');
