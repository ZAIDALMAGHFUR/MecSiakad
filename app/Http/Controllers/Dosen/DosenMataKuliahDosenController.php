<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Dosen;
use App\Models\DosenMatkul;
use App\Models\Mata_Kuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DosenMataKuliahDosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::Where('users_id', Auth::user()->id)->first();
        $dsnmatkul = DosenMatkul::Where('dosen_id', $dosen->id)->get();
        return view('dashboard.dosen.data-matkul.index', compact('dsnmatkul'));
    }
}