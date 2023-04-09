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

    public function find(Request $request){
        // dd($request->all());
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
    
        $select_krs = Krs::where('nim', $request->nim)
        ->where('tahun_academic_id', $request->tahun_academic_id)
        ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
        ->select('krs.id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
        ->get();
    
        $tahun_academic_id = TahunAcademic::findOrFail($request->tahun_academic_id);
        $data_krs = [
            'nim' => $request->nim,
            'tahun_academic_id' => $request->tahun_academic_id,
            'nama_lengkap' => $mhs->nama_lengkap,
            'tahun_academic' => $tahun_academic_id->tahun_academic_id,
            'semester' => $tahun_academic_id->semester,
            'prody' => $mhs->program_studies->name,
            'select_krs' => $select_krs
        ];
    
        return view('dashboard.master.krs.show', compact('data_krs'));
    }
    
    public function add($nim, $tahun_akademik_id)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        $program_studies_id = $mahasiswa->program_studies_id;
        
        $data_mata_kuliah = Mata_Kuliah::where('program_studies_id', $program_studies_id)
                                        ->get(['name_mata_kuliah', 'id']);

        $tahun_akademik = TahunAcademic::find($tahun_akademik_id);
    
        return view('dashboard.master.krs.create', compact('nim', 'tahun_akademik', 'data_mata_kuliah'));
    }

    public function store(krsRequest $request)
    {
        if ($request->validated()) {
            
            Krs::create([
                'nim' => $request->nim,
                'tahun_academic_id' => $request->tahun_academic_id,
                'mata_kuliah_id' => $request->mata_kuliah_id,
            ]);

            return redirect()->route('dashboard.master.krs.index')->with([
                'info' => 'Data berhasil ditambahkan !',
                'alert-type' => 'success'
            ]);
        }
    }

    public function destroy($id)
    {
        $krs = Krs::find($id);
        $krs->delete();

        return redirect()->route('krs.find')->with([
            'info' => 'Data berhasil dihapus !',
            'alert-type' => 'success'
        ]);
    }

}
