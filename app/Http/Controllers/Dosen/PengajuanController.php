<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengajuanController extends Controller
{
    public function index()
    {   
        $Pengajuan = Pengajuan::all();
        return view('dashboard.dosen.pengajuan.index', compact('Pengajuan'));
    }
}
