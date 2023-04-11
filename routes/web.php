<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\calonController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\Admin\KhsController;
use App\Http\Controllers\Admin\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PMB\FotosController;
use App\Http\Controllers\Admin\MatkulController;
use App\Http\Controllers\PMB\PenggunaController;
use App\Http\Controllers\PMB\JadwalPmbController;
use App\Http\Controllers\PMB\PendaftarController;
use App\Http\Controllers\ProgrammStudiController;
use App\Http\Controllers\PMB\PembayaranController;
use App\Http\Controllers\PMB\PengugumanController;
use App\Http\Controllers\PMB\PendaftaranController;
use App\Http\Controllers\PMB\PersyaratanController;
use App\Http\Controllers\Admin\AdminDosenController;
use App\Http\Controllers\Admin\InputNilaiController;
use App\Http\Controllers\Admin\ThnAkademikController;
use App\Http\Controllers\Admin\DosenJabatanController;
use App\Http\Controllers\Admin\JabatanDosenController;
use App\Http\Controllers\PMB\PengumumanCambaController;
use App\Http\Controllers\PMB\PendaftaranCambaController;
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

    //dosen import excel
    Route::post('import_excel_dosen', [AdminDosenController::class, 'importExcel'])->name('import_excel_dosen');
    Route::get('export_excel_dosen', [AdminDosenController::class, 'exportExcel'])->name('export_excel_dosen');

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

    //dosen jabatan
    Route::controller(DosenJabatanController::class)->prefix('dsnjabatan')->group(function () {
        Route::get('', 'index')->name('dsnjabatan');
        Route::get('add', 'add')->name('dsnjabatan.add');
        Route::post('save', 'store')->name('dsnjabatan.save');
        Route::get('edit/{id}', 'edit')->name('dsnjabatan.edit');
        Route::post('update/{id}', 'update')->name('dsnjabatan.update');
        Route::delete('delete/{id}', 'destroy')->name('dsnjabatan.delete');
    });

    //krs
    Route::controller(KrsController::class)->prefix('krs')->group(function () {
        Route::get('', 'index')->name('krs');
        Route::post('', 'find')->name('krs.find');
        Route::get('add/{nim}/{tahun_academic}', 'add')->name('krs.create');
        Route::post('save', 'store')->name('krs.store');
        Route::get('edit/{krs:id}', 'edit')->name('krs.edit');
        Route::post('update/{krs:id}', 'update')->name('krs.update');
        Route::delete('delete/{id}', 'destroy')->name('krs.destroy');
    });

    //input nilai
    Route::controller(InputNilaiController::class)->prefix('nilai')->group(function () {
        Route::get('', 'index')->name('nilai');
        Route::get('edit/{id}', 'edit')->name('nilai.edit');
        Route::post('update', 'update')->name('nilai.update');
        Route::delete('delete/{id}', 'destroy')->name('nilai.delete');
    });

    //khs
    Route::controller(KhsController::class)->prefix('khs')->group(function () {
        Route::get('', 'index')->name('khs');
        Route::post('', 'find')->name('khs.find');
        Route::get('add/{nim}/{tahun_academic}', 'add')->name('khs.create');
        Route::post('save', 'store')->name('khs.store');
        Route::get('edit/{krs:id}', 'edit')->name('khs.edit');
        Route::post('update/{krs:id}', 'update')->name('khs.update');
        Route::delete('delete/{id}', 'destroy')->name('khs.destroy');
    });

    //jadwal pmb
    Route::controller(JadwalPmbController::class)->prefix('jadwalpmb')->group(function () {
        Route::get('', 'index')->name('jadwalpmb');
        Route::get('add', 'add')->name('jadwalpmb.add');
        Route::post('save', 'store')->name('jadwalpmb.save');
        Route::get('edit/{id}', 'edit')->name('jadwalpmb/edit');
        Route::post('update/{id}', 'update')->name('jadwalpmb/update');
        Route::delete('delete/{id}', 'destroy')->name('jadwalpmb/delete');
    });

    //pengguna
    Route::controller(PenggunaController::class)->prefix('pengguna')->group(function () {
        Route::get('', 'index')->name('pengguna');
        Route::delete('delete/{id}', 'destroy')->name('pengguna/delete');
    });

    //pendaftar
    Route::controller(PendaftarController::class)->prefix('pendaftar')->group(function () {
        Route::get('', 'index')->name('pendaftar');
        Route::delete('delete/{id}', 'destroy')->name('pendaftar/delete');
    });

    //verifikasi pendaftar
    Route::get('/verified-registration/{id_pendaftaran}', [PendaftarController::class, 'verifikasistatuspendaftaran']);
    Route::get('/notverified-registration/{id_pendaftaran}', [PendaftarController::class, 'notverifikasistatuspendaftaran']);
    Route::get('/invalid-registration/{id_pendaftaran}', [PendaftarController::class, 'invalidstatuspendaftaran']);
    Route::get('/finish-registration/{id_pendaftaran}', [PendaftarController::class, 'selesaistatuspendaftaran']);
    Route::get('/detail-registration/{id_pendaftaran}', [PendaftarController::class, 'detailpendaftaran']);


    //pembayaran 
    Route::controller(PembayaranController::class)->prefix('pembayaran')->group(function () {
        Route::get('', 'index')->name('pembayaran');
        Route::delete('delete/{id}', 'destroy')->name('pembayaran/delete');
    });

    //pemmbayaran change status
    Route::get('/paid-payment/{id_pembayaran}', [PembayaranController::class, 'verifikasipembayaran']);
    Route::get('/unpaid-payment/{id_pembayaran}', [PembayaranController::class, 'belumbayar']);
    Route::get('/invalid-payment/{id_pembayaran}', [PembayaranController::class, 'invalidbayar']);

    //pengumuman
    Route::controller(PengugumanController::class)->prefix('penguguman')->group(function () {
        Route::get('', 'index')->name('penguguman');
        Route::delete('delete/{id}', 'destroy')->name('penguguman/delete');
    });
    
    //pengumuman change 
    Route::get('/view-announcement/{id_pendaftaran}', [PengugumanController::class, 'lihatpengumuman']);
    Route::post('/save-announcement', [PengugumanController::class, 'simpanpengumuman']);
    Route::post('/update-announcement/{id}', [PengugumanController::class, 'updatepengumuman']);



    //persyaratan
    Route::controller(PersyaratanController::class)->prefix('persyaratan')->group(function () {
        Route::get('', 'index')->name('persyaratan');
        Route::get('add', 'add')->name('persyaratan.add');
        Route::post('save', 'store')->name('persyaratan.save');
        Route::get('edit/{id}', 'edit')->name('persyaratan.edit');
        Route::post('update/{id}', 'update')->name('persyaratan.update');
        Route::delete('delete/{id}', 'destroy')->name('persyaratan.delete');
    });

    //foto brosur
    Route::controller(FotosController::class)->prefix('foto')->group(function () {
        Route::get('', 'index')->name('foto');
        Route::get('add', 'add')->name('foto.add');
        Route::post('save', 'store')->name('foto.save');
        Route::get('edit/{id}', 'edit')->name('foto.edit');
        Route::post('update/{id}', 'update')->name('foto.update');
        Route::delete('delete/{id}', 'destroy')->name('foto.delete');
    });
});


//dosen
Route::group(['middleware'=> ['auth', 'OnlyDosen']], function () {
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
});


//mahasiswa
Route::group(['middleware'=> ['auth', 'OnlyMahasiswa']], function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
});



Route::group(['middleware'=> ['auth', 'Camba']], function () {

    Route::get('calon', [calonController::class, 'index'])->name('calon');

    //pendaftaran
    Route::controller(PendaftaranCambaController::class)->prefix('camba')->group(function () {
        Route::get('', 'index')->name('camba');
        Route::post('save', 'simpanpendaftaran')->name('camba/save');
        Route::get('edit/{id}', 'edit')->name('camba.edit');
        Route::post('update/{id}', 'update')->name('camba.update');
        Route::delete('delete/{id}', 'destroy')->name('camba.delete');
    });
    Route::get('/detail-registration-camba/{id_pendaftaran}', [PendaftaranCambaController::class, 'detailpendaftaran']);
    Route::post('/upload-payment', [PembayaranController::class, 'updatebuktipembayaran'])->name('upload-payment');
    Route::get('/card-registration/{id_pendaftaran}', [PendaftaranCambaController::class, 'kartupendaftaran']);

    //lihat pengumuman
    Route::get('/view-graduation/{id_pendaftaran}', [PendaftaranCambaController::class, 'lihatkelulusan']);
});








Route::get('/job-search',  [App\Http\Controllers\JobController::class, 'index'])->name('job-search');

Route::get('/zoom', [\App\Http\Controllers\ZoomController::class, 'index'])->name('zoom');
Route::get('/zoom/create', [\App\Http\Controllers\ZoomController::class, 'create'])->name('zoom/create');
Route::post('/zoom/save', [\App\Http\Controllers\ZoomController::class, 'save'])->name('zoom/save');
Route::delete('/zoom/delete/{id}', [\App\Http\Controllers\ZoomController::class, 'delete'])->name('zoom.delete');

