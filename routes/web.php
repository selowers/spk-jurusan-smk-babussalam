<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SAWController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/password/change', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.change.post');

Route::middleware('auth')->group(function () {
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
});
