<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Krs;
use App\Models\Dosen;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\BobotNilai;
use App\Models\DosenMatkul;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Models\Mata_Kuliah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    public function index()
    {   
        $mahasiswa = Mahasiswa::all();
        $nilai = Nilai::all();
        return view('dashboard.dosen.input-nilai.index', compact('mahasiswa', 'nilai'));
    }




    public function find(Request $request, $id){
        $bobot = BobotNilai::all();
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        $tahun_akademik = TahunAcademic::all();
        $dosen = Dosen::Where('users_id', Auth::user()->id)->first();
        
        if ($dosen->dosenJabatans()->first()->jabatan_id != '1') {
            $krsQuery = Krs::query()
                ->where('nim', $mahasiswa->nim);
            $dsnmatkul = DosenMatkul::where('dosen_id', $dosen->id)
                ->pluck('mata_kuliah_id');
            $krsQuery->whereIn('mata_kuliah_id', $dsnmatkul);
        } else {
            $dsnmatkul = DosenMatkul::where('dosen_id', $dosen->id)->get();
            $turu = Mata_Kuliah::whereIn('program_studies_id', $dsnmatkul->pluck('program_studies_id'))->get()->pluck('id');
            $krsQuery = Krs::query()
                ->whereIn('mata_kuliah_id', $turu, 'OR')
                ->where('nim', $mahasiswa->nim);
        }
    
        if($request->has('tahun_academic_id')){
            $krsQuery->where('tahun_academic_id', $request->tahun_academic_id);
        }else{
            $krsQuery->whereIn('tahun_academic_id', $tahun_akademik->pluck('id'));
        }
    
        $krs = $krsQuery->get();

        $nilais = Nilai::where('mahasiswas_id', $id)
        ->get()
        // ->pluck('mata_kuliahs_id')
        ->toArray();

    return view('dashboard.dosen.input-nilai.edit', compact('mahasiswa', 'krs', 'tahun_akademik', 'bobot', 'nilais'));

    }
    



    public function update(Request $request)
{
    
    $validator = Validator::make($request->all(), [
        'tahun_academic_id.*' => 'required',
        'mahasiswa_id.*' => 'required',
        'mata_kuliahs_id.*' => 'required',
        'tugas.*' => 'required',
        'kuis.*' => 'required',
        'partisipasi_pembelajaran.*' => 'required',
        'uts.*' => 'required',
        'uas.*' => 'required',
        'nilai_akhir.*' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Nilai gagal disimpan.');
    }

    $tahun_academic_id = $request->input('tahun_academic_id');
    $mahasiswa_id = $request->input('mahasiswa_id');
    $mata_kuliahs_id = $request->input('mata_kuliahs_id');
    $tugas = $request->input('tugas');
    $partisipasi_pembelajaran = $request->input('partisipasi_pembelajaran');
    $kuis = $request->input('kuis');
    $uts = $request->input('uts');
    $uas = $request->input('uas');
    $nilai_akhir = $request->input('nilai_akhir');

    // loop through the input arrays to create the new records
    $total = count($tugas) - 1;
    for ($key = 0; $key <= $total ; $key++) {
        $nilai = new Nilai;
        $nilai->tahun_academic_id = $tahun_academic_id[$key];
        $nilai->mahasiswas_id = $mahasiswa_id[$key];
        $nilai->mata_kuliahs_id = $mata_kuliahs_id[$key];
        $nilai->tugas = $tugas[$key];
        $nilai->partisipasi_pembelajaran = $partisipasi_pembelajaran[$key];
        $nilai->kuis = $kuis[$key];
        $nilai->uts = $uts[$key];
        $nilai->uas = $uas[$key];
        $nilai->nilai_akhir = $nilai_akhir[$key];
        $nilai->save();
    }

    return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
}
}
