<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
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
    
}
