<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\calonController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PMB\MabaController;
use App\Http\Controllers\Admin\KhsController;
use App\Http\Controllers\Admin\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PMB\FotosController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Dosen\NilaiController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\JurnalController;
use App\Http\Controllers\Admin\MatkulController;
use App\Http\Controllers\Dosen\JobDsnController;
use App\Http\Controllers\PMB\PenggunaController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Mahasiswa\GetController;
use App\Http\Controllers\Mahasiswa\KtmController;
use App\Http\Controllers\PMB\JadwalPmbController;
use App\Http\Controllers\PMB\PendaftarController;
use App\Http\Controllers\ProgrammStudiController;
use App\Http\Controllers\Dosen\CalendarController;
use App\Http\Controllers\PMB\PembayaranController;
use App\Http\Controllers\PMB\PengugumanController;
use App\Http\Controllers\Admin\EditNilaiController;
use App\Http\Controllers\Dosen\PengajuanController;
use App\Http\Controllers\PMB\PendaftaranController;
use App\Http\Controllers\PMB\PersyaratanController;
use App\Http\Controllers\Admin\AdminDosenController;
use App\Http\Controllers\Admin\BobotNilaiController;
use App\Http\Controllers\Admin\InputNilaiController;
use App\Http\Controllers\Admin\StrJabatanController;
use App\Http\Controllers\Mahasiswa\GetKHSController;
use App\Http\Controllers\Mahasiswa\JobMhsController;
use App\Http\Controllers\Admin\DosenMatkulController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\SelectedKtmController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\ThnAkademikController;
use App\Http\Controllers\Mahasiswa\SkripsiController;
use App\Http\Controllers\Admin\DosenJabatanController;
use App\Http\Controllers\Admin\FullCalendarController;
use App\Http\Controllers\Admin\JabatanDosenController;
use App\Http\Controllers\Mahasiswa\SettingsController;
use App\Http\Controllers\PMB\PengumumanCambaController;
use App\Http\Controllers\PMB\PendaftaranCambaController;
use App\Http\Controllers\Admin\CreateMahasiswaController;
use App\Http\Controllers\Dosen\EdiNilaiMahasiswaController;
use App\Http\Controllers\Admin\StrukturKepemimpinanController;
use App\Http\Controllers\Dosen\DosenMataKuliahDosenController;
use App\Http\Controllers\Mahasiswa\CalendarAcademicController;
use App\Http\Controllers\Mahasiswa\ModulDownloadController;

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
Route::controller(StrJabatanController::class)->prefix('jabatans')->name('jabatans.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('add', 'add')->name('add');
    Route::post('save', 'store')->name('save');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('update/{id}', 'update')->name('update');
    Route::delete('delete/{id}', 'destroy')->name('delete');
});

Route::get('/', [LandingPageController::class, 'index'])->name('landing-pages.index');
Route::get('/p/berita', [LandingPageController::class, 'berita'])->name('landing-pages.berita');
Route::get('/p/berita/{berita}', [LandingPageController::class, 'beritaDetail'])
    ->name('landing-pages.berita.detail');
Route::get('/p/jurnal', [LandingPageController::class, 'jurnal'])->name('landing-pages.jurnal');
Route::get('/p/jurnal/{jurnal}', [LandingPageController::class, 'jurnalDetail'])
    ->name('landing-pages.jurnal.detail');
Route::get('/p/pages/{page}', [LandingPageController::class, 'pageDetail'])
    ->name('landing-pages.pages.detail');
Route::get('/p/gallery', [LandingPageController::class, 'galleries'])->name('landing-pages.galleries');
Route::get('/p/gallery/{gallery}', [LandingPageController::class, 'galleryDetail'])->name('landing-pages.gallery-detail');

Route::get('/p/struktur-kepemimpinan', [LandingPageController::class, 'strukturKps'])->name('landing-pages.struktur-kps');
Route::post('/hide-modal', [LandingPageController::class, 'hideModal'])->name('landing-pages.hide-modal');
Route::get('/sejarah', [LandingPageController::class, 'sejarah'])->name('landing-pages.sejarah');
Route::get('/visi-misi', [LandingPageController::class, 'visiMisi'])->name('landing-pages.visi-misi');
Route::get('/kontak', [LandingPageController::class, 'kontak'])->name('landing-pages.kontak');
Route::get('/prodi-kimia', [LandingPageController::class, 'prodi'])->name('landing-pages.prodi-kimia');
Route::get('/prodi-industri', [LandingPageController::class, 'prodiindustri'])->name('landing-pages.prodi-industri');

//download
Route::get('/download-public', [LandingPageController::class, 'download'])->name('landing-pages.download-umum');
Route::get('/download-public/{id}', [LandingPageController::class, 'downloadrill'])->name('landing-pages.download-umum-rill');


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'OnlyAdmin']], function () {
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

    //dosen matkul
    Route::controller(DosenMatkulController::class)->prefix('dsnmatkul')->group(function () {
        Route::get('', 'index')->name('dsnmatkul');
        Route::get('add', 'create')->name('dsnmatkul.add');
        Route::post('save', 'store')->name('dsnmatkul.save');
        Route::get('edit/{id}', 'edit')->name('dsnmatkul.edit');
        Route::post('update/{id}', 'update')->name('dsnmatkul.update');
        Route::delete('delete/{id}', 'destroy')->name('dsnmatkul.delete');
    });

    //rentang nilai
    Route::controller(BobotNilaiController::class)->prefix('rentang')->group(function () {
        Route::get('', 'index')->name('rentang');
        Route::get('add', 'add')->name('rentang.add');
        Route::post('save', 'store')->name('rentang.save');
        Route::get('edit/{id}', 'edit')->name('rentang.edit');
        Route::post('update/{id}', 'update')->name('rentang.update');
        Route::delete('delete/{id}', 'destroy')->name('rentang.delete');
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
    Route::get('Nilai/export/{ta}/{ps}', [InputNilaiController::class, 'export'])->name('nilai.export');

    //edit nilai
    Route::controller(EditNilaiController::class)->prefix('change')->group(function () {
        Route::get('', 'index')->name('change');
        Route::get('edit/{id}', 'change')->name('change.edit');
        Route::get('replacement/{id}', 'replacement')->name('change.replacement');
        Route::post('update/{id}', 'update')->name('change.update');
        Route::delete('delete/{id}', 'destroy')->name('change.delete');
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
        Route::delete('deleteAll', 'deleteAll')->name('pengguna/deleteAll');
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


    //maba
    Route::controller(MabaController::class)->prefix('maba')->group(function () {
        Route::get('', 'index')->name('maba');
        Route::get('maba', 'export')->name('maba.export');
    });


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

    //kalender akademik
    Route::get('getevent', [FullCalendarController::class, 'getEvent'])->name('getevent');
    Route::post('createevent', [FullCalendarController::class, 'createEvent'])->name('createevent');
    Route::post('deleteevent', [FullCalendarController::class, 'deleteEvent'])->name('deleteevent');

    Route::get('/job-search',  [App\Http\Controllers\JobController::class, 'index'])->name('job-search');
    Route::get('/job-country/{search}',  [App\Http\Controllers\JobController::class, 'search']);

    Route::get('/zoom', [\App\Http\Controllers\ZoomController::class, 'index'])->name('zoom');
    Route::get('/zoom/create', [\App\Http\Controllers\ZoomController::class, 'create'])->name('zoom/create');
    Route::post('/zoom/save', [\App\Http\Controllers\ZoomController::class, 'save'])->name('zoom/save');
    Route::delete('/zoom/delete/{id}', [\App\Http\Controllers\ZoomController::class, 'delete'])->name('zoom.delete');



    //berita
    Route::controller(BeritaController::class)->prefix('berita')->name('berita.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('add', 'add')->name('add');
        Route::post('save', 'store')->name('save');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('delete/{id}', 'destroy')->name('delete');
    });
    //jurnal
    Route::controller(JurnalController::class)->prefix('jurnal')->name('jurnal.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('add', 'add')->name('add');
        Route::post('save', 'store')->name('save');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('delete/{id}', 'destroy')->name('delete');
    });
    //page
    Route::controller(PageController::class)->prefix('page')->name('page.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('add', 'add')->name('add');
        Route::post('save', 'store')->name('save');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('delete/{id}', 'destroy')->name('delete');
    });
    //galeri
    Route::controller(GalleryController::class)->prefix('galeri')->name('galeri.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('add', 'add')->name('add');
        Route::post('save', 'store')->name('save');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('delete/{id}', 'destroy')->name('delete');
    });
    // gallery items
    Route::controller(GalleryItemController::class)->prefix('gallery-items')->name('gallery-items.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('add', 'add')->name('add');
        Route::post('save', 'store')->name('save');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('delete/{id}', 'destroy')->name('delete');
    });
    // jabatans

    // struktur-kps
    Route::controller(StrukturKepemimpinanController::class)->prefix('struktur-kepemimpinan')->name('struktur-kps.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('add', 'add')->name('add');
        Route::post('save', 'store')->name('save');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('delete/{id}', 'destroy')->name('delete');
    });


    //ktm mahasiswa
    Route::controller(SelectedKtmController::class)->prefix('ktm')->group(function () {
        Route::get('', 'index')->name('ktm');
        Route::get('ktmsatu', 'ktmsatu')->name('ktm.ktmsatu');
        Route::get('ktmdua', 'ktmdua')->name('ktm.ktmdua');
        Route::get('ktmtiga', 'ktmtiga')->name('ktm.ktmtiga');
        Route::post('update', 'update')->name('ktm.update');
    });

    //download
    Route::controller(DownloadController::class)->prefix('download')->group(function () {
        Route::get('', 'index')->name('download');
        Route::get('/add', 'add')->name('add.download');
        Route::post('/save', 'store')->name('save.download');
        Route::get('/edit/{id}', 'edit')->name('edit.download');
        Route::post('/update/{id}', 'update')->name('update.download');
        Route::delete('/delete/{id}', 'delete')->name('delete.download');
        Route::get('/file/{id}', 'download')->name('file.download');
    });

});


//dosen
Route::group(['middleware' => ['auth', 'OnlyDosen']], function () {
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');

    //matakuliah
    Route::controller(DosenMataKuliahDosenController::class)->prefix('matkuldosen')->group(function () {
        Route::get('', 'index')->name('matkuldosen');
    });

    //input nilai
    Route::controller(NilaiController::class)->prefix('nilaidosen')->group(function () {
        Route::get('', 'index')->name('nilaidosen');
        Route::get('find/{id}', 'find')->name('nilaidosen.find');
        Route::post('update', 'update')->name('nilaidosen.update');
        Route::get('cetak-dosen/{ta}/{matkul}', 'export')->name('compensation.export');
    });

    //edit nilai
    Route::controller(EdiNilaiMahasiswaController::class)->prefix('compensation')->group(function () {
        Route::get('', 'index')->name('compensation');
        Route::get('edit/{id}', 'change')->name('compensation.edit');
        Route::get('replacement/{id}', 'compensation')->name('compensation.replacement');
        Route::post('update/{id}', 'update')->name('compensation.update');
        Route::delete('delete/{id}', 'destroy')->name('compensation.delete');
    });

    //kalender akademik
    Route::get('getdosenevent', [CalendarController::class, 'getDosenEvent'])->name('getdosenevent');


    //pengajuan judul
    Route::controller(PengajuanController::class)->prefix('pengajuan')->group(function () {
        Route::get('', 'index')->name('pengajuan');
    });
    Route::post('save-pengajuan/{id}', [PengajuanController::class, 'update']);
    Route::get('ambil/{id}/{nama}', [PengajuanController::class, 'ambiljudul'])->name('pengajuan.ambil');

    //job search
    Route::get('/job-dsn',  [JobDsnController::class, 'indexDsn'])->name('job-dsn');
    Route::get('/job-country-dsn/{search}',  [JobDsnController::class, 'searchDsn']);
});





//mahasiswa
Route::group(['middleware' => ['auth', 'OnlyMahasiswa']], function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');


    //ambil krs
    Route::controller(GetController::class)->prefix('mhskrs')->group(function () {
        Route::get('', 'index')->name('mhskrs');
        Route::get('cari ', 'cari')->name('mhskrs.cari');
        Route::post('', 'find')->name('mhskrs.find');
        Route::get('add/{nim}/{tahun_academic}', 'add')->name('mhskrs.create');
        Route::post('save', 'store')->name('mhskrs.store');
        Route::get('edit/{krs:id}', 'edit')->name('mhskrs.edit');
        Route::post('update/{krs:id}', 'update')->name('mhskrs.update');
    });
    Route::get('cetak', [GetController::class, 'cetak'])->name('mhskrs.cetak');

    //khs
    Route::controller(GetKHSController::class)->prefix('mhskhs')->group(function () {
        Route::get('', 'index')->name('mhskhs');
        Route::post('', 'find')->name('mhskhs.find');
    });
    Route::get('cetak-khs', [GetKHSController::class, 'cetak'])->name('mhskhs.cetak');

    //kalender akademik
    Route::get('getmahasiswaevent', [CalendarAcademicController::class, 'getMahasiswaEvent'])->name('getmahasiswaevent');

    //pengajuan judul
    Route::controller(SkripsiController::class)->prefix('mhsjudul')->group(function () {
        Route::get('', 'index')->name('mhsjudul');
        Route::get('add', 'add')->name('mhsjudul.add');
        Route::post('save', 'store')->name('mhsjudul.save');
        Route::get('edit/{id}', 'edit')->name('mhsjudul.edit');
        Route::post('update/{id}', 'update')->name('mhsjudul.update');
        Route::delete('delete/{id}', 'destroy')->name('mhsjudul.delete');
    });

    Route::get('pengajuan-cetak', [SkripsiController::class, 'pengajuan'])->name('pengajuan-cetak');
    Route::get('pengajuan-cetak-acc', [SkripsiController::class, 'cetakacc'])->name('pengajuan-cetak-acc');

    //job search
    Route::get('/job-mhs',  [JobMhsController::class, 'indexMhs'])->name('job-mhs');
    Route::get('/job-country-mhs/{search}',  [JobMhsController::class, 'searchMhs']);


    //setting profile
    Route::controller(SettingsController::class)->prefix('profile')->group(function () {
        Route::get('', 'index')->name('profile');
        Route::put('/user-update', 'updatePassword')->name('profile.update');
    });



    //ktm mahasiswa
    route::get('cetak-ktm', [KtmController::class, 'index'])->name('ktm.index');

    Route::get('mhs-profile', [MahasiswaController::class, 'profile'])->name('mhs-profile');

            //download
            Route::controller(ModulDownloadController::class)->prefix('mhs-download')->group(function () {
                Route::get('', 'index')->name('mhs-download');
                Route::get('/file/{id}', 'download')->name('mhs.download');
            });
});





Route::group(['middleware' => ['auth', 'Camba']], function () {

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
