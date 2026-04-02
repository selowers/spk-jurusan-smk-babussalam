<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SAWController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::resource('siswa', SiswaController::class);
Route::resource('kriteria', KriteriaController::class);
Route::resource('jurusan', JurusanController::class);
Route::post('jurusan/add-fakultas', [JurusanController::class, 'addFakultas'])->name('jurusan.addFakultas');
Route::post('jurusan/add-perguruan-tinggi', [JurusanController::class, 'addPerguruanTinggi'])->name('jurusan.addPerguruanTinggi');

// Routes untuk SAW
Route::get('saw', [SAWController::class, 'index'])->name('saw.index');
Route::get('saw/create', [SAWController::class, 'create'])->name('saw.create');
Route::get('saw/{id}', [SAWController::class, 'show'])->name('saw.show');
Route::get('saw/{id}/edit', [SAWController::class, 'edit'])->name('saw.edit');
Route::put('saw/{id}', [SAWController::class, 'update'])->name('saw.update');
Route::get('saw-hasil', [SAWController::class, 'hasil'])->name('saw.hasil');
Route::post('saw/proses', [SAWController::class, 'proses'])->name('saw.proses');
Route::post('saw/simpan', [SAWController::class, 'simpan'])->name('saw.simpan');
