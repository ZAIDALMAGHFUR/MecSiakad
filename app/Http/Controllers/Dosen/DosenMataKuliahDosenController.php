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
         //dd($dosen->dosenJabatans());
        $dosen_jabatan = $dosen->dosenJabatans()->first();
        if ($dosen_jabatan->jabatan_id == '1') {
            $dsnmatkul = Mata_Kuliah::where('program_studies_id', $dosen_jabatan->program_studies_id)->get();
        } else {
            $dsnmatkul = DosenMatkul::Where('dosen_id', $dosen->id)->get();
        }
        return view('dashboard.dosen.data-matkul.index', compact('dsnmatkul'));
    }

//     public function index()
// {
//     $dosen = Dosen::where('users_id', Auth::user()->id)->first();
//     // dd($dosen->dosenJabatans);
//     $dsnmatkul = [];

//     if ($dosen) {
//         $dosenJabatan = $dosen->dosenJabatans()->first();
        
//         if ($dosenJabatan && $dosenJabatan->jabatan_id == '1') {
//             $dsnmatkul = DosenMatkul::where('dosen_id', $dosen->id)->get();
//         }
//     }

//     return view('dashboard.dosen.data-matkul.index', compact('dsnmatkul'));
// }

}