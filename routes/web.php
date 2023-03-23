<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProgrammStudiController;

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

Auth::routes();


Route::group(['middleware'=> ['auth', 'OnlyAdmin']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //program studi
    Route::get('/program-studi', [ProgrammStudiController::class, 'index'])->name('program-studi');
    Route::get('/program-studi/add', [ProgrammStudiController::class, 'add'])->name('program-studi.add');
    Route::post('/program-studi/store', [ProgrammStudiController::class, 'store'])->name('program-studi.store');
    Route::get('/program-studi/edit/{id}', [ProgrammStudiController::class, 'edit'])->name('program-studi.edit');
    Route::post('/program-studi/update/{id}', [ProgrammStudiController::class, 'update'])->name('program-studi.update');
    Route::delete('/program-studi/delete/{id}', [ProgrammStudiController::class, 'destroy'])->name('program-studi.delete');
});

Route::group(['middleware'=> ['auth', 'OnlyDosen']], function () {
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
});


Route::group(['middleware'=> ['auth', 'OnlyMahasiswa']], function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
});

Route::get('/job-search',  [App\Http\Controllers\JobController::class, 'index'])->name('job-search');

Route::get('/zoom', [\App\Http\Controllers\ZoomController::class, 'index'])->name('zoom');
Route::get('/zoom/create', [\App\Http\Controllers\ZoomController::class, 'create'])->name('zoom/create');
Route::post('/zoom/save', [\App\Http\Controllers\ZoomController::class, 'save'])->name('zoom/save');
Route::delete('/zoom/delete/{id}', [\App\Http\Controllers\ZoomController::class, 'delete'])->name('zoom.delete');

