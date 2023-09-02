<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\DosenMatkul;
use App\Models\Mata_Kuliah;
use App\Models\DosenJabatan;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $mhsinfo = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $nim = $mhsinfo->nim;
        $data = (object)[];
        $data->mhs = Mahasiswa::where('nim', $nim)->first();
        $data->tahun_academic = TahunAcademic::where('status', 'aktif')->first();
        $data->tahun_akademik_id = $data->tahun_academic->id;
        $data->program_studies_id = $data->mhs->program_studies_id;
        $select_krs = Krs::where('nim', $nim)
            ->where('tahun_academic_id', $data->tahun_akademik_id)
            ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
            ->select('krs.id', 'krs.mata_kuliah_id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
            ->get();
            // dd($select_krs);

        $matkul = $select_krs->pluck('mata_kuliah_id');
        $dsnmatkul = DosenMatkul::whereIn('mata_kuliah_id', $matkul, 'OR')->get();
        $ketua_prodi_id = DosenJabatan::where('jabatan_id', 1)->where('program_studies_id', $data->program_studies_id)->first();

        // dd($select_krs);
        $total_semester = $select_krs->sum('tahun_akademik_id.sks');
        // dd($total_semester);

        // dd($dsnmatkul);

        $data->total_sks = 0;
        foreach ($select_krs as $itung_sks) {
            $data->total_sks += $itung_sks->sks;
        }
        $download ='KRS-'. $data->mhs->name .'.pdf';
        // return view('dashboard.mahasiswa.cetak.cetak', compact('data', 'select_krs', 'dsnmatkul', 'ketua_prodi_id'));
        return Pdf::loadHTML(view('dashboard.mahasiswa.cetak.cetak', compact('data', 'select_krs', 'dsnmatkul', 'ketua_prodi_id')))->download($download);
    }
}
