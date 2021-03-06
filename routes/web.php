<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Http\Request;

Route::get('mahasiswas/search', [MahasiswaController::class, 'search'])->name('mahasiswas.search');

Route::resource('mahasiswas', MahasiswaController::class);

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('mahasiswas/nilai/{Nim}', [MahasiswaController::class, 'nilai'])->name('mahasiswas.nilai');
Route::get('mahasiswas/search', [MahasiswaController::class, 'search'])->name('mahasiswas.search');

Route::resource('mahasiswas', MahasiswaController::class);

Route::get('mahasiswas/cetak_pdf/{Nim}', [MahasiswaController::class, 'cetak_pdf'])->name('mahasiswas.cetak_pdf');
