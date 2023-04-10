<?php

namespace App\Http\Controllers\Admin;

use App\Models\Krs;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Mata_kuliah;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Models\Program_studies;
use App\Http\Controllers\Controller;

class InputNilaiController extends Controller
{

    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        $nilai = Nilai::all();
        return view('dashboard.master.input-nilai.index', compact('mahasiswa', 'nilai'));
    }

    public function edit(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        $krs = Krs::where('nim', $mahasiswa->nim)->get();

        // dd($krs);
        return view('dashboard.master.input-nilai.edit', compact('mahasiswa','krs'));
    }
}
