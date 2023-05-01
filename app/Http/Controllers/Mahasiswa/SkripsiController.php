<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
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
        $mahasiswa_id = auth()->user()->mahasiswa->id;
    
        // mengambil data pengajuan yang dimiliki oleh mahasiswa yang sedang login
        $pengajuan = Pengajuan::where('mahasiswa_id', $mahasiswa_id)->get();

        //mengambil data dosen dengan jabatan ketua prodi
        
        return view('dashboard.mahasiswa.pengajuan.create', compact('pengajuan', 'mahasiswa_id'));
    }

    public function store(Request $request)
    {
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

    public function pengajuan(){
        $mahasiswa_id = auth()->user()->mahasiswa->id;
    
        // mengambil data pengajuan yang dimiliki oleh mahasiswa yang sedang login
        $pengajuan = Pengajuan::where('mahasiswa_id', $mahasiswa_id)->get();

        //mengambil data tahun akademik yang aktif
        $tahun_akademik = TahunAcademic::where('status', 'aktif')->first();

        return view('dashboard.mahasiswa.pengajuan.surat', compact('pengajuan', 'tahun_akademik'));
    }
    
}
