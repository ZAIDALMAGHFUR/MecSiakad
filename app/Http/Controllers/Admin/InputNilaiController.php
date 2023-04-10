<?php

namespace App\Http\Controllers\Admin;

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

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::all();
        $nilai = Nilai::find($id);
        $programStudi = Program_studies::all();
        
        // Menambahkan filter mata kuliah
        $mataKuliah = Mata_kuliah::all();
        $selectedMataKuliah = $nilai->mata_kuliah_id;
    
        // Menambahkan filter tahun akademik
        $tahunAcademik = TahunAcademic::all();
        $selectedTahunAcademik = $nilai->tahun_akademik_id;
    
        return view('dashboard.master.input-nilai.edit', compact('mahasiswa', 'nilai', 'programStudi', 'mataKuliah', 'selectedMataKuliah', 'tahunAcademik', 'selectedTahunAcademik'));
    }
    

    public function destroy($id)
    {
        $nilai = Nilai::find($id);
        $nilai->delete();
        return redirect()->route('admin.inputnilai.index')->with('success', 'Data Berhasil Dihapus');
    }
}
