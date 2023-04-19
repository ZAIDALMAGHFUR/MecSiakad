<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Models\Mata_Kuliah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GetController extends Controller
{
    public function index()
    {
        $mhs = Mahasiswa::Where('user_id', Auth::user()->id)
        ->first();
        $krs = Krs::where('nim', $mhs->nim)->get();
        $TahunAcademic = TahunAcademic::all();
        // dd($mhs);
        return view('dashboard.mahasiswa.krs.index', compact('TahunAcademic', 'krs', 'mhs'));
    }

public function find(Request $request)
{
    $this->validate(request(), [
        'tahun_academic_id' => 'required',
    ]);

    $mhs = Mahasiswa::Where('user_id', Auth::user()->id)
    ->first();
    $nim = $mhs->nim;

    $mhs = Mahasiswa::where('nim', $nim)->first();
    if(is_null($mhs)) {
        return redirect()->back()->with([
            'info' => 'mahasiswa belum terdaftar !',
            'alert-type' => 'info'
        ]);
    }

    $tahun_academic = TahunAcademic::findOrFail($request->tahun_academic_id);
    if ($tahun_academic->status != 'aktif') {

        $select_krs = Krs::where('nim', $nim)
        ->where('tahun_academic_id', $request->tahun_academic_id)
        ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
        ->select('krs.id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
        ->get();

        $data_krs = [
            'nim' => $nim,
            'tahun_academic_id' => $request->tahun_academic_id,
            'name' => $mhs->name,
            'tahun_academic' => $tahun_academic->tahun_akademik,
            'semester' => $tahun_academic->semester,
            'prody' => $mhs->program_studies->name,
            'select_krs' => $select_krs
        ];

        return view('dashboard.mahasiswa.krs.show', compact('data_krs', 'tahun_academic'));
    }

    $select_krs = Krs::where('nim', $nim)
        ->where('tahun_academic_id', $request->tahun_academic_id)
        ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
        ->select('krs.id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
        ->get();

    $data_krs = [
        'nim' => $nim,
        'tahun_academic_id' => $request->tahun_academic_id,
        'name' => $mhs->name,
        'tahun_academic' => $tahun_academic->tahun_akademik,
        'semester' => $tahun_academic->semester,
        'prody' => $mhs->program_studies->name,
        'select_krs' => $select_krs
    ];

    return view('dashboard.mahasiswa.krs.show', compact('data_krs', 'tahun_academic'));
}

    
    
    public function add($nim, $tahun_akademik_id)
{
    $mahasiswa = Mahasiswa::where('nim', $nim)->first();
    $program_studies_id = $mahasiswa->program_studies_id;

    $data_mata_kuliah = Mata_Kuliah::where('program_studies_id', $program_studies_id)
        ->whereNotIn('id', function($query) use ($nim, $tahun_akademik_id) {
            $query->select('mata_kuliah_id')
                ->from('krs')
                ->where('nim', $nim)
                ->where('tahun_academic_id', $tahun_akademik_id);
        })->get(['name_mata_kuliah', 'id']);

    $tahun_akademik = TahunAcademic::find($tahun_akademik_id);

    return view('dashboard.mahasiswa.krs.create', compact('nim', 'tahun_akademik', 'data_mata_kuliah'));
}


public function store(Request $request)
{
    $this->validate(request(), [
        'nim' => 'required',
        'tahun_academic_id' => 'required',
        'mata_kuliah_id' => 'required|array',
    ]);

    foreach ($request->mata_kuliah_id as $mata_kuliah_id) {
        Krs::create([
            'nim' => $request->nim,
            'tahun_academic_id' => $request->tahun_academic_id,
            'mata_kuliah_id' => $mata_kuliah_id,
        ]);
    }

    return redirect()->route('mhskrs')->with([
        'info' => 'berhasil dibuat!',
        'alert-type' => 'success'
    ]);
}


public function edit($id){
    $krs = Krs::find($id);
    $mahasiswa = Mahasiswa::where('nim', $krs->nim)->first();
    $program_studies_id = $mahasiswa->program_studies_id;

    $data_mata_kuliah = Mata_Kuliah::where('program_studies_id', $program_studies_id)->get(['name_mata_kuliah', 'id']);

    $tahun_akademik = TahunAcademic::find($krs->tahun_academic_id);

    return view('dashboard.mahasiswa.krs.edit', compact('krs', 'tahun_akademik', 'data_mata_kuliah'));
}




    public function update(Request $request, $id)
{
    $this->validate(request(), [
        'nim' => 'required',
        'tahun_academic_id' => 'required',
        'mata_kuliah_id' => 'required',
    ]);

    $krs = Krs::find($id);
    $krs->update([
        'nim' => $request->nim,
        'tahun_academic_id' => $request->tahun_academic_id,
        'mata_kuliah_id' => $request->mata_kuliah_id,
    ]);

    return redirect()->route('mhskrs')->with([
        'info' => 'berhasil dibuat!',
        'alert-type' => 'success'
    ]);
}

public function cetak()
{
    return view('dashboard.mahasiswa.cetak.cetak');
}
}