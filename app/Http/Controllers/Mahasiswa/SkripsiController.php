<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Pengajuan;
use App\Models\DosenJabatan;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class SkripsiController extends Controller
{
    public function index()
    {
        // mendapatkan ID mahasiswa yang sedang login
        $mahasiswa_id = auth()->user()->mahasiswa->id;
    
        // mengambil data pengajuan yang dimiliki oleh mahasiswa yang sedang login
        $pengajuan = Pengajuan::where('mahasiswa_id', $mahasiswa_id)->get();
    
        return view('dashboard.mahasiswa.pengajuan.index', compact('pengajuan'));
    }

    public function add()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $mahasiswa_id = $mahasiswa->id;
        $program_studies_id = $mahasiswa->program_studies_id;
        // mengambil data pengajuan yang dimiliki oleh mahasiswa yang sedang login
        $pengajuan = Pengajuan::where('mahasiswa_id', $mahasiswa_id)->get();

        //mengambil data dosen dengan jabatan ketua prodi
        $ketua_prodi_id = DosenJabatan::where('jabatan_id', 1)->where('program_studies_id',  $program_studies_id)->first();
        // dd($ketua_prodi_id);
        return view('dashboard.mahasiswa.pengajuan.create', compact('pengajuan', 'mahasiswa_id', 'ketua_prodi_id'));
    }

    public function store(Request $request)
    {
        // dd($request->all());    
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'judul_1' => 'required',
            'judul_2' => 'required',
            'judul_3' => 'required',
            'mahasiswa_id' => 'required',
            'dosen_id' => 'required',
        ]);

        Pengajuan::create($request->all());


        return redirect()->back()->with([
            'success' => 'Pengajuan berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }

    // public function edit($id)
    // {
    //     $pengajuan = Pengajuan::findOrFail($id);
    //     $mahasiswa = auth()->user()->mahasiswa;
    //     $mahasiswa_id = $mahasiswa->id;
    //     $program_studies_id = $mahasiswa->program_studies_id;
    //     //mengambil data dosen dengan jabatan ketua prodi
    //     $ketua_prodi_id = DosenJabatan::where('jabatan_id', 1)->where('program_studies_id',  $program_studies_id)->first();
    //     // dd($ketua_prodi_id);
    //     return view('dashboard.mahasiswa.pengajuan.edit', compact('pengajuan', 'mahasiswa_id', 'ketua_prodi_id'));
    // }

    // public function update(Request $request, $id){

    // }


    public function destroy($id){
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();

        return redirect()->back()->with([
            'success' => 'Pengajuan berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }

    public function pengajuan(){
        $mahasiswa = auth()->user()->mahasiswa;
        $mahasiswa_id = $mahasiswa->id;
    
        // mengambil data pengajuan yang dimiliki oleh mahasiswa yang sedang login
        $pengajuan = Pengajuan::where('mahasiswa_id', $mahasiswa_id)->get();

        //mengambil data tahun akademik yang aktif
        $tahun_akademik = TahunAcademic::where('status', 'aktif')->first();

        $download ='Judul Skripsi-'. $mahasiswa->name .'.pdf';
        // return view('dashboard.mahasiswa.khs.cetak.cetak', compact('data', 'ketua_prodi_id', 'nilai_akhirs', 'select_krs', 'total_sks', 'total_nilai', 'ipk'));
        return Pdf::loadHTML(view('dashboard.mahasiswa.pengajuan.surat', compact('pengajuan', 'tahun_akademik')))->download($download);
    }

    public function cetakacc(){
        $mahasiswa = auth()->user()->mahasiswa;
        $mahasiswa_id = $mahasiswa->id;
    
        // mengambil data pengajuan yang dimiliki oleh mahasiswa yang sedang login
        $pengajuan = Pengajuan::where('mahasiswa_id', $mahasiswa_id)->get();

        //mengambil data tahun akademik yang aktif
        $tahun_akademik = TahunAcademic::where('status', 'aktif')->first();

        $download ='Judul Skripsi-'. $mahasiswa->name .'.pdf';
        // return view('dashboard.mahasiswa.pengajuan.suratacc', compact('pengajuan', 'tahun_akademik'));
        return Pdf::loadHTML(view('dashboard.mahasiswa.pengajuan.suratacc', compact('pengajuan', 'tahun_akademik')))->download($download);
    }
    
}
