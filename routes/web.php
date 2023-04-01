<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\calonController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Admin\MatkulController;
use App\Http\Controllers\ProgrammStudiController;
use App\Http\Controllers\Admin\AdminDosenController;
use App\Http\Controllers\Admin\ThnAkademikController;
use App\Http\Controllers\Admin\JabatanDosenController;
use App\Http\Controllers\Admin\CreateMahasiswaController;

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

Auth::routes(['verify' => true]);


Route::group(['middleware'=> ['auth', 'OnlyAdmin']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //program studi
    Route::get('/program-studi', [ProgrammStudiController::class, 'index'])->name('program-studi');
    Route::get('/program-studi/add', [ProgrammStudiController::class, 'add'])->name('program-studi.add');
    Route::post('/program-studi/store', [ProgrammStudiController::class, 'store'])->name('program-studi.store');
    Route::get('/program-studi/edit/{id}', [ProgrammStudiController::class, 'edit'])->name('program-studi.edit');
    Route::post('/program-studi/update/{id}', [ProgrammStudiController::class, 'update'])->name('program-studi.update');
    Route::delete('/program-studi/delete/{id}', [ProgrammStudiController::class, 'destroy'])->name('program-studi.delete');


    //mahaiswa import excel
    Route::post('import_excel', [CreateMahasiswaController::class, 'importExcel'])->name('import_excel');
    Route::get('export_excel', [CreateMahasiswaController::class, 'exportExcel'])->name('export_excel');
    //mahasiswa
    Route::get('/mahasiswa-admin', [CreateMahasiswaController::class, 'index'])->name('mahasiswa.admin');
    Route::get('/mahasiswa-admin/add', [CreateMahasiswaController::class, 'create'])->name('mahasiswa.admin.add');
    Route::post('/mahasiswa-admin/store', [CreateMahasiswaController::class, 'store'])->name('mahasiswa.admin.store');
    Route::get('/mahasiswa-admin/edit/{id}', [CreateMahasiswaController::class, 'edit'])->name('mahasiswa.admin.edit');
    Route::post('/mahasiswa-admin/update/{id}', [CreateMahasiswaController::class, 'update'])->name('mahasiswa.admin.update');
    Route::get('/mahasiswa-admin/show/{id}', [CreateMahasiswaController::class, 'show'])->name('mahasiswa.admin.show');
    Route::delete('/mahasiswa-admin/delete/{id}', [CreateMahasiswaController::class, 'destroy'])->name('mahasiswa.admin.delete');

    //tahun akademik
    Route::controller(ThnAkademikController::class)->prefix('thnakademik')->group(function () {
        Route::get('', 'index')->name('thnakademik');
        Route::get('add', 'add')->name('thnakademik/add');
        Route::post('save', 'store')->name('thnakademik/save');
        Route::get('edit/{id}', 'edit')->name('thnakademik/edit');
        Route::put('update/{id}', 'update')->name('thnakademik/update');
        Route::delete('delete/{id}', 'destroy')->name('thnakademik/delete');
    });

    //mata kuliah
    Route::controller(MatkulController::class)->prefix('matkul')->group(function () {
        Route::get('', 'index')->name('matkul');
        Route::get('add', 'add')->name('matkul.add');
        Route::post('save', 'store')->name('matkul.save');
        Route::get('edit/{id}', 'edit')->name('matkul.edit');
        Route::post('update/{id}', 'update')->name('matkul.update');
        Route::delete('delete/{id}', 'destroy')->name('matkul.delete');
    });

    //jabatan dosen
    Route::controller(JabatanDosenController::class)->prefix('jabatan')->group(function () {
        Route::get('', 'index')->name('jabatan');
        Route::get('add', 'add')->name('jabatan/add');
        Route::post('save', 'store')->name('jabatan/save');
        Route::get('edit/{id}', 'edit')->name('jabatan/edit');
        Route::put('update/{id}', 'update')->name('jabatan/update');
        Route::delete('delete/{id}', 'destroy')->name('jabatan/delete');
    });

    //dosen
    Route::controller(AdminDosenController::class)->prefix('dosen-admin')->group(function () {
        Route::get('', 'index')->name('dosen/admin');
        Route::get('add', 'add')->name('dosen-admin/add');
        Route::post('save', 'store')->name('dosen-admin/save');
        Route::get('edit/{id}', 'edit')->name('dosen-admin/edit');
        Route::post('update/{id}', 'update')->name('dosen-admin/update');
        Route::get('show/{id}', 'show')->name('dosen-admin/show');
        Route::delete('delete/{id}', 'destroy')->name('dosen-admin/delete');
    });
});

Route::group(['middleware'=> ['auth', 'OnlyDosen']], function () {
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
});


Route::group(['middleware'=> ['auth', 'OnlyMahasiswa']], function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
});

Route::get('calon', [calonController::class, 'index'])->name('calon');

Route::get('/job-search',  [App\Http\Controllers\JobController::class, 'index'])->name('job-search');

Route::get('/zoom', [\App\Http\Controllers\ZoomController::class, 'index'])->name('zoom');
Route::get('/zoom/create', [\App\Http\Controllers\ZoomController::class, 'create'])->name('zoom/create');
Route::post('/zoom/save', [\App\Http\Controllers\ZoomController::class, 'save'])->name('zoom/save');
Route::delete('/zoom/delete/{id}', [\App\Http\Controllers\ZoomController::class, 'delete'])->name('zoom.delete');

