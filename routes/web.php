<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KarirController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RiwayatJabatanController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\UnitkerjaController;
use App\Http\Controllers\UnitkerjaEksternalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'beranda'])->name('');
    Route::get('/beranda', [HomeController::class, 'beranda'])->name('beranda');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('api')->name('api')->group(function () {
        Route::get('chartBeranda', [HomeController::class, 'chartBeranda'])->name('.chartBeranda');
        Route::get('pegawaiBeranda', [HomeController::class, 'pegawaiBeranda'])->name('.pegawaiBeranda');
    });

    Route::prefix('unitkerja')->name('unitkerja')->group(function () {
        Route::get('', [UnitkerjaController::class, 'index'])->name('.index');
        Route::post('hapus', [UnitkerjaController::class, 'truncate'])->name('.truncate');
        Route::get('unggah', [UnitkerjaController::class, 'upload'])->name('.upload');
        Route::post('post-unggah', [UnitkerjaController::class, 'uploadPost'])->name('.upload.post');
        Route::get('unduh', [UnitkerjaController::class, 'download'])->name('.download');
    });

    Route::prefix('eksternal-uker')->name('eksternal')->group(function () {
        Route::get('', [UnitkerjaEksternalController::class, 'index'])->name('.index');
        Route::post('hapus', [UnitkerjaEksternalController::class, 'truncate'])->name('.truncate');
        Route::get('unggah', [UnitkerjaEksternalController::class, 'upload'])->name('.upload');
        Route::post('post-unggah', [UnitkerjaEksternalController::class, 'uploadPost'])->name('.upload.post');
        Route::get('unduh', [UnitkerjaEksternalController::class, 'download'])->name('.download');
    });

    Route::prefix('posisi')->name('posisi')->group(function () {
        Route::get('', [PosisiController::class, 'index'])->name('.index');
        Route::post('hapus', [PosisiController::class, 'truncate'])->name('.truncate');
        Route::get('unggah', [PosisiController::class, 'upload'])->name('.upload');
        Route::post('post-unggah', [PosisiController::class, 'uploadPost'])->name('.upload.post');
        Route::get('unduh', [PosisiController::class, 'download'])->name('.download');
    });

    Route::prefix('pegawai')->name('pegawai')->group(function () {
        Route::get('', [PegawaiController::class, 'index'])->name('.index');
        Route::post('hapus', [PegawaiController::class, 'truncate'])->name('.truncate');
        Route::get('unggah', [PegawaiController::class, 'upload'])->name('.upload');
        Route::post('post-unggah', [PegawaiController::class, 'uploadPost'])->name('.upload.post');
        Route::get('unduh', [PegawaiController::class, 'download'])->name('.download');
    });

    Route::prefix('pelatihan')->name('pelatihan')->group(function () {
        Route::get('', [PelatihanController::class, 'index'])->name('.index');
        Route::post('hapus', [PelatihanController::class, 'truncate'])->name('.truncate');
        Route::get('unggah', [PelatihanController::class, 'upload'])->name('.upload');
        Route::post('post-unggah', [PelatihanController::class, 'uploadPost'])->name('.upload.post');
        Route::get('unduh', [PelatihanController::class, 'download'])->name('.download');
    });

    Route::prefix('riwayat')->name('riwayat')->group(function () {
        Route::get('', [RiwayatJabatanController::class, 'index'])->name('.index');
        Route::post('hapus', [RiwayatJabatanController::class, 'truncate'])->name('.truncate');
        Route::get('unggah', [RiwayatJabatanController::class, 'upload'])->name('.upload');
        Route::post('post-unggah', [RiwayatJabatanController::class, 'uploadPost'])->name('.upload.post');
        Route::get('unduh', [RiwayatJabatanController::class, 'download'])->name('.download');
    });

    Route::prefix('karir')->name('karir')->group(function () {
        Route::get('', [KarirController::class, 'index'])->name('.index');
        Route::get('/detail', [KarirController::class, 'show'])->name('.show');
        Route::get('/sunting', [KarirController::class, 'edit'])->name('.edit');
        Route::post('/sunting', [KarirController::class, 'update'])->name('.update');
        Route::get('/generate-pdf', [KarirController::class, 'generatePdf'])->name('.generatePdf');
        Route::get('/generate-excel', [KarirController::class, 'generateExcel'])->name('.generateExcel');
        Route::get('/generate-object', [KarirController::class, 'generateObject'])->name('.generateObject');
        Route::get('/generate-karir', [KarirController::class, 'generateKarir'])->name('.generateKarir');
    });
});
