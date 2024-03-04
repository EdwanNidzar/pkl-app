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
Route::get('/parpols/{nama}/pelanggaran', [ParpolController::class, 'pelanggaran'])->name('parpols.pelanggaran');

Route::resource('jenispelanggaran', JenisPelanggaranController::class)->middleware(['auth','role:bawaslu-provinsi']);
Route::get('/jenispelanggaran/{nama}/pelanggaran', [JenisPelanggaranController::class, 'pelanggaran'])->name('jenispelanggaran.pelanggaran');

Route::resource('pelanggaran', PelanggaranController::class);

Route::resource('laporan', LaporanController::class)
    ->middleware(['auth','role:bawaslu-provinsi|bawaslu-kota|panwascam']);
Route::post('/laporan/{id}/verify', [LaporanController::class, 'verify'])
    ->name('laporan.verify')
    ->middleware(['auth', 'role:bawaslu-provinsi']);
Route::post('/laporan/{id}/reject', [LaporanController::class, 'reject'])
    ->name('laporan.reject')
    ->middleware(['auth', 'role:bawaslu-provinsi']);
Route::get('/maps', [LaporanController::class, 'maps'])
    ->name('maps');

Route::resource('suratkerja', SuratKerjaController::class)->middleware(['auth','role:bawaslu-provinsi|bawaslu-kota|panwascam']);

Route::resource('users', UsersController::class)->middleware(['auth','role:bawaslu-provinsi']);
Route::patch('/users/{id}/makeProvinsi', [UsersController::class, 'makeProvinsi'])->name('users.makeProvinsi');
Route::patch('/users/{id}/makeKota', [UsersController::class, 'makeKota'])->name('users.makeKota');
Route::patch('/users/{id}/makePanwascam', [UsersController::class, 'makePanwascam'])->name('users.makePanwascam');

require __DIR__.'/auth.php';
