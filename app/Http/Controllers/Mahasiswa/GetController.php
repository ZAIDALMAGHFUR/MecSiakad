<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GetController extends Controller
{
    public function index(Request $request)
    {
        $mhs = Mahasiswa::Where('user_id', Auth::user()->id)
        ->first();
        $krs = Krs::where('nim', $mhs->nim)->get();

        // $tahun_academic = TahunAcademic::findOrFail($request->tahun_academic_id);
    
        $select_krs = Krs::where('nim', $mhs->nim)
            ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
            ->select('krs.id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
            ->get();
    
        $data_krs = [
            'nim' => $mhs->nim,
            'name' => $mhs->name,
            'prody' => $mhs->program_studies->name,
            'select_krs' => $select_krs
        ];
        // dd($krs);
        // dd($select_krs);
        // dd($tahun_academic);
        return view('dashboard.mahasiswa.krs.index', compact('data_krs'));
    }

    
}
