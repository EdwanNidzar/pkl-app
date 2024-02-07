<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParpolController;
use App\Http\Controllers\JenisPelanggaranController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SuratKerjaController;

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

/*
|--------------------------------------------------------------------------
    TODO : give middleware verified to each route
|--------------------------------------------------------------------------
|
| example :
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('parpols', ParpolController::class)->middleware(['auth', 'verified','role:bawaslu-provinsi']);

*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('parpols', ParpolController::class)->middleware(['auth','role:bawaslu-provinsi']);

Route::resource('jenispelanggaran', JenisPelanggaranController::class)->middleware(['auth','role:bawaslu-provinsi']);

Route::resource('pelanggaran', PelanggaranController::class)->middleware(['auth','role:bawaslu-provinsi|bawaslu-kota']);

Route::resource('laporan', LaporanController::class)->middleware(['auth','role:bawaslu-provinsi|bawaslu-kota|panwascam']);
Route::post('/laporan/{id}/verify', [LaporanController::class, 'verify'])->name('laporan.verify');
Route::post('/laporan/{id}/reject', [LaporanController::class, 'reject'])->name('laporan.reject');

Route::resource('suratkerja', SuratKerjaController::class)->middleware(['auth','role:bawaslu-provinsi|bawaslu-kota|panwascam']);

Route::get('provinsi', function () {
    return '<h1>Welcome Bawaslu Provinsi</h1>';
})->middleware(['auth','role:bawaslu-provinsi']);

Route::get('kota', function () {
    return '<h1>Welcome Bawaslu Kota</h1>';
})->middleware(['auth','role:bawaslu-kota|bawaslu-provinsi']);

require __DIR__.'/auth.php';
