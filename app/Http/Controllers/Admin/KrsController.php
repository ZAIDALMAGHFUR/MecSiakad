<?php

namespace App\Http\Controllers\Admin;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Mata_Kuliah;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Http\Requests\krsRequest;
use App\Http\Controllers\Controller;

class KrsController extends Controller
{
    public function index()
    {
        $TahunAcademic = TahunAcademic::all();
        return view('dashboard.master.krs.index', compact('TahunAcademic'));
    }

    public function find(Request $request)
    {
        $this->validate(request(), [
            'tahun_academic_id' => 'required',
            'nim' => 'required',
        ]);
    
        $mhs = Mahasiswa::where('nim', $request->nim)->first();
        if(is_null($mhs)) {
            return redirect()->back()->with([
                'info' => 'mahasiswa belum terdaftar !',
                'alert-type' => 'info'
            ]);
        }
    
        $tahun_academic = TahunAcademic::findOrFail($request->tahun_academic_id);
        if ($tahun_academic->status != 'aktif') {

            $select_krs = Krs::where('nim', $request->nim)
            ->where('tahun_academic_id', $request->tahun_academic_id)
            ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
            ->select('krs.id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
            ->get();

            $data_krs = [
                'nim' => $request->nim,
                'tahun_academic_id' => $request->tahun_academic_id,
                'name' => $mhs->name,
                'tahun_academic' => $tahun_academic->tahun_academic_id,
                'semester' => $tahun_academic->semester,
                'prody' => $mhs->program_studies->name,
                'select_krs' => $select_krs
            ];

            return view('dashboard.master.krs.show', compact('data_krs', 'tahun_academic'));
        }
    
        $select_krs = Krs::where('nim', $request->nim)
            ->where('tahun_academic_id', $request->tahun_academic_id)
            ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
            ->select('krs.id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
            ->get();
    
        $data_krs = [
            'nim' => $request->nim,
            'tahun_academic_id' => $request->tahun_academic_id,
            'name' => $mhs->name,
            'tahun_academic' => $tahun_academic->tahun_academic_id,
            'semester' => $tahun_academic->semester,
            'prody' => $mhs->program_studies->name,
            'select_krs' => $select_krs
        ];
    
        return view('dashboard.master.krs.show', compact('data_krs', 'tahun_academic'));
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

    return view('dashboard.master.krs.create', compact('nim', 'tahun_akademik', 'data_mata_kuliah'));
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

    return redirect()->route('krs')->with([
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

    return view('dashboard.master.krs.edit', compact('krs', 'tahun_akademik', 'data_mata_kuliah'));
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

    return redirect()->route('krs')->with([
        'info' => 'berhasil dibuat!',
        'alert-type' => 'success'
    ]);
}

    public function destroy($id)
    {
        $krs = Krs::find($id);
        $krs->delete();

        return redirect()->back()->with([
            'info' => 'berhasi di hapus !',
            'alert-type' => 'success'
        ]);
    }

}
