<?php

use App\Http\Controllers\BalitaController;
use App\Http\Controllers\CekPemeriksaanController;
use App\Http\Controllers\ibuController;
use App\Http\Controllers\p_balitaController;
use App\Http\Controllers\p_ibuController;
use App\Http\Controllers\PelaporanBalitaController;
use App\Http\Controllers\PelaporanIbuController;
use App\Http\Controllers\PelaporanP_BalitaController;
use App\Http\Controllers\PelaporanP_IbuController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

// --CRUD-- //
Route::resource('ibu', ibuController::class);
Route::get('/ibu', [App\Http\Controllers\ibuController::class, 'index'])->name('ibu');

Route::resource('balita', BalitaController::class);
Route::get('/balita', [App\Http\Controllers\BalitaController::class, 'index'])->name('balita');

Route::resource('p_ibu', p_ibuController::class);
Route::get('/p_ibu', [App\Http\Controllers\p_ibuController::class, 'index'])->name('p_ibu');

Route::resource('p_balita', p_balitaController::class);
Route::get('/p_balita', [App\Http\Controllers\p_balitaController::class, 'index'])->name('p_balita');

// --PELAPORAN-- //
Route::get('/pelaporan_ibu', [PelaporanIbuController::class, 'index'])->name('pelaporan.ibu');
Route::get('/laporan/ibu/pdf', [PelaporanIbuController::class, 'generateIbuPdf'])->name('laporan.ibu.pdf');

Route::get('/pelaporan_balita', [PelaporanBalitaController::class, 'index'])->name('pelaporan.balita');
Route::get('/laporan/balita/pdf', [PelaporanBalitaController::class, 'generateBalitaPdf'])->name('laporan.balita.pdf');

Route::get('/pelaporan_pemeriksaan_ibu', [PelaporanP_IbuController::class, 'index'])->name('pelaporan.pemeriksaan_ibu');
Route::get('/laporan/pemeriksaan_ibu/pdf', [PelaporanP_IbuController::class, 'generateIbuPdf'])->name('laporan.pemeriksaan_ibu.pdf');

Route::get('/pelaporan_pemeriksaan_balita', [PelaporanP_BalitaController::class, 'index'])->name('pelaporan.pemeriksaan_balita');
Route::get('/laporan/pemeriksaan_balita/pdf', [PelaporanP_BalitaController::class, 'generateBalitaPdf'])->name('laporan.pemeriksaan_balita.pdf');

// --Cek NIK-- //
Route::get('/cek_nik', [CekPemeriksaanController::class, 'cekNIK'])->name('cek.nik');
