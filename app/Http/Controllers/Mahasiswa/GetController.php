<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GetController extends Controller
{
    public function index(Request $request)
    {
        $mhs = Mahasiswa::Where('user_id', Auth::user()->id)
        ->first();
        $krs = Krs::where('nim', $mhs->nim)->get();

    
        $select_krs = Krs::where('nim', $mhs->nim)
            ->where('tahun_academic_id', $mhs->tahun_academic_id)
            ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
            ->select('krs.id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
            ->get();
    
        $data_krs = [
            'nim' => $mhs->nim,
            'tahun_academic_id' => $mhs->tahun_academic_id,
            'name' => $mhs->name,
            'prody' => $mhs->program_studies->name,
            'select_krs' => $select_krs
        ];
        // dd($krs);
        // dd($data_krs);
        return view('dashboard.mahasiswa.krs.index', compact('data_krs'));
    }
    
}
