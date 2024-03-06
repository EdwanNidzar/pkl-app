<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParpolController;
use App\Http\Controllers\JenisPelanggaranController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SuratKerjaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PDFController;

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

Route::resource('dashboard', DashboardController::class)->middleware(['auth','role:bawaslu-provinsi|bawaslu-kota|panwascam']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('parpols', ParpolController::class)->middleware(['auth','role:bawaslu-provinsi']);
Route::get('/pelanggaran/parpols/{id}', [ParpolController::class, 'pelanggaran'])->name('parpols.pelanggaran');
Route::get('/cetakParpols', [PDFController::class, 'cetakParpols'])->name('cetakParpols');
Route::get('/cetakParpolsById/{id}', [PDFController::class, 'cetakParpolsById'])->name('cetakParpolsById');

Route::resource('jenispelanggaran', JenisPelanggaranController::class)->middleware(['auth','role:bawaslu-provinsi']);
Route::get('/pelanggaran/jenispelanggaran/{id}', [JenisPelanggaranController::class, 'pelanggaran'])->name('jenispelanggaran.pelanggaran');
Route::get('/cetakJenisPelanggaran', [PDFController::class, 'cetakJenisPelanggaran'])->name('cetakJenisPelanggaran');
Route::get('/cetakJenisPelanggaranById/{id}', [PDFController::class, 'cetakJenisPelanggaranById'])->name('cetakJenisPelanggaranById');

Route::resource('pelanggaran', PelanggaranController::class);
Route::get('/cetakPelanggaran', [PDFController::class, 'cetakPelanggaran'])->name('cetakPelanggaran');
Route::get('/cetakPelanggaranById/{id}', [PDFController::class, 'cetakPelanggaranById'])->name('cetakPelanggaranById');

Route::resource('laporan', LaporanController::class)
    ->middleware(['auth','role:bawaslu-provinsi|bawaslu-kota|panwascam']);
Route::post('/laporan/{id}/verify', [LaporanController::class, 'verify'])
    ->name('laporan.verify')
    ->middleware(['auth', 'role:bawaslu-provinsi']);
Route::post('/laporan/{id}/reject', [LaporanController::class, 'reject'])
    ->name('laporan.reject')
    ->middleware(['auth', 'role:bawaslu-provinsi']);
Route::get('/cetakLaporan', [PDFController::class, 'cetakLaporan'])->name('cetakLaporan');
Route::get('/cetakLaporanById/{id}', [PDFController::class, 'cetakLaporanById'])->name('cetakLaporanById');


Route::resource('suratkerja', SuratKerjaController::class)->middleware(['auth','role:bawaslu-provinsi|bawaslu-kota|panwascam']);

Route::resource('users', UsersController::class)->middleware(['auth','role:bawaslu-provinsi']);
Route::patch('/users/{id}/makeProvinsi', [UsersController::class, 'makeProvinsi'])->name('users.makeProvinsi');
Route::patch('/users/{id}/makeKota', [UsersController::class, 'makeKota'])->name('users.makeKota');
Route::patch('/users/{id}/makePanwascam', [UsersController::class, 'makePanwascam'])->name('users.makePanwascam');

require __DIR__.'/auth.php';
