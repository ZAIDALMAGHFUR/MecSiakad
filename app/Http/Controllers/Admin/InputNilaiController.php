<?php

namespace App\Http\Controllers\Admin;

use App\Models\Krs;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\BobotNilai;
use App\Models\Mata_kuliah;
use App\Exports\NilaiExport;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Models\Program_studies;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class InputNilaiController extends Controller
{

    public function index(Request $request)
    {
        $nilai = Nilai::all(); //mengambil semua data nilai
        $thn = TahunAcademic::all();
        $prodi = Program_studies::all();

        $mahasiswa = Mahasiswa::query();
        if ($request->tahun_academics_id && $request->program_studies_id) {
            $mahasiswa->where('tahun_academics_id', $request->tahun_academics_id)
                ->where('program_studies_id', $request->program_studies_id);
        } elseif ($request->tahun_academics_id) {
            $mahasiswa->where('tahun_academics_id', $request->tahun_academics_id);
        } elseif ($request->program_studies_id) {
            $mahasiswa->where('program_studies_id', $request->program_studies_id);
        }
        $mahasiswa = $mahasiswa->get();
        
        $export = (object)[];
        $export->ta = $request->tahun_academics_id ?? '0';
        $export->ps = $request->program_studies_id ?? '0';

        

        return view('dashboard.master.input-nilai.index', compact('mahasiswa', 'nilai', 'thn', 'prodi', 'export'));
    }

    public function edit(Request $request, $id)
    {
        $bobot = BobotNilai::all();
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        $tahun_akademik = TahunAcademic::all();
        
        $krsQuery = Krs::query()
            ->where('nim', $mahasiswa->nim);
            
            if($request->has('tahun_academic_id')){
                $krsQuery->where('tahun_academic_id', $request->tahun_academic_id);
                $nilais = Nilai::where('mahasiswas_id', $id)
                ->where('tahun_academic_id', $request->tahun_academic_id)
                ->get()
                ->toArray();
            }else{
                $krsQuery->whereIn('tahun_academic_id', $tahun_akademik->pluck('id'));
                $nilais = Nilai::where('mahasiswas_id', $id)
                ->get()
                ->toArray();
            }
        
            $krs = $krsQuery->get();
    
        return view('dashboard.master.input-nilai.edit', compact('mahasiswa', 'krs', 'tahun_akademik', 'bobot', 'nilais'));
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

// public function export() 
// {
//     return Excel::download(new NilaiExport, 'Nilai.xlsx');
// }


public function export($ta, $ps) 
{
    //dd($ta);
    return Excel::download(new NilaiExport($ta, $ps), 'Nilai.xlsx');
}

}
