<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NilaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginProses'])->name('login');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


//admin
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/dashboard/admin', [\App\Http\Controllers\DashboardController::class, 'showAdmin'])->name('dashboard.admin');
    Route::resource('/jabatan', App\Http\Controllers\JabatanController::class);
    Route::resource('/tahun-ajaran', App\Http\Controllers\TahunAjaranController::class);
    Route::resource('/pegawai', App\Http\Controllers\PegawaiController::class);
    Route::resource('/mapel', App\Http\Controllers\MapelController::class);
    Route::resource('/wali-kelas', App\Http\Controllers\WaliKelasController::class);
    Route::resource('/siswa', App\Http\Controllers\SiswaController::class);
    Route::get('/create-siswa/{tahunAjaranId}/{kelasId}', [\App\Http\Controllers\SiswaController::class, 'create'])->name('siswa.create');
    Route::get('/lihat-kelas/{tahunAjaranId}', [\App\Http\Controllers\SiswaController::class, 'showKelas'])->name('siswa.showKelas');
    Route::get('/lihat-siswa/{tahunAjaranId}/{kelasId}', [\App\Http\Controllers\SiswaController::class, 'showSiswa'])
        ->name('siswa.showSiswa');


    Route::resource('kelas', App\Http\Controllers\KelasController::class);
});


//guru
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('dashboard/pergawai', [\App\Http\Controllers\DashboardController::class, 'showPegawai'])->name('dashboard.pegawai');
    Route::get('/thn-ajaran', [\App\Http\Controllers\NilaiController::class, 'tahunAjaran'])->name('tahun.ajaran');
    Route::get('/kelas-nilai/{tahunAjaranId}/', [App\Http\Controllers\NilaiController::class, 'index'])->name('nilai.index');
    Route::get('/nilai/lihat/{tahunAjaranId}/{wali_kelas_id}', [NilaiController::class, 'lihat'])->name('nilai.lihat');
    Route::get('/nilai/create/{siswa_id}', [NilaiController::class, 'create'])->name('nilai.create');
    Route::post('/nilai/store', [NilaiController::class, 'store'])->name('nilai.store');
    Route::get('lihat-nilai/{wali_kelas_id}/{tahun_ajaran_id}', [\App\Http\Controllers\NilaiController::class, 'lihatNilai'])->name('lihat.nilai');
    Route::get('/nilai/edit/{id}', [NilaiController::class, 'edit'])->name('nilai.edit');
    Route::post('/nilai/update/{id}', [NilaiController::class, 'update'])->name('nilai.update');
    // Route::get('/nilai/cetak/{kelas_id}', [NilaiController::class, 'cetakPDF'])->name('nilai.cetakPDF');
    // web.php
    Route::get('/nilai/cetak/{kelas_id}', [NilaiController::class, 'cetakPDF'])->name('nilai.cetakPDF');
});


Route::middleware(['auth', 'role:0'])->group(function () {
    Route::get('/data-nilai/siswa', [\App\Http\Controllers\SiswaNilaiController::class, 'index'])->name('data-nilai.siswa');
});
