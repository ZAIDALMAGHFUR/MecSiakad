<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dosen;
use App\Models\DosenMatkul;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Models\Program_studies;
use App\Models\Mata_Kuliah;
use App\Http\Controllers\Controller;

class DosenMatkulController extends Controller
{
    public function index()
    {
        $dsn = DosenMatkul::all();
        // dd($dsn);
        return view('dashboard.master.dosen-matkul.index', compact('dsn'));
    }

    public function create()
    {
        $dosen = Dosen::all();
        $tahun_academics = TahunAcademic::all();
        $program_studies = Program_studies::all();
        $mata_kuliahs = Mata_Kuliah::with('program_studies')->get();
        return view('dashboard.master.dosen-matkul.add', compact('dosen', 'tahun_academics', 'program_studies', 'mata_kuliahs'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'dosen_id' => 'required',
            'tahun_academics_id' => 'required',
            'program_studies_id' => 'required',
            'mata_kuliah_id' => 'required'
        ], [
            'dosen_id.required' => 'Silahkan isi Nama Dosen terlebih dahulu!',
            'tahun_academics_id.required' => 'Silahkan isi Tahun Akademik terlebih dahulu!',
            'program_studies_id.required' => 'Silahkan isi Program Studi terlebih dahulu!',
            'mata_kuliah_id.required' => 'Silahkan isi Mata Kuliah terlebih dahulu!'
        ]);

        //create post
        DosenMatkul::create([
            'dosen_id' => $request->dosen_id,
            'tahun_academics_id' => $request->tahun_academics_id,
            'program_studies_id' => $request->program_studies_id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
        ]);

        return redirect()->route('dsnmatkul')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $data = DosenMatkul::find($id);
        $dosen = Dosen::all();
        $tahun_academics = TahunAcademic::all();
        $program_studies = Program_studies::all();
        $mata_kuliahs = Mata_Kuliah::all();
        return view('dashboard.master.dosen-matkul.edit', compact('data', 'dosen', 'tahun_academics', 'program_studies', 'mata_kuliahs'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'dosen_id' => 'required',
            'tahun_academics_id' => 'required',
            'program_studies_id' => 'required',
            'mata_kuliah_id' => 'required'
        ], [
            'dosen_id.required' => 'Silahkan isi Nama Dosen terlebih dahulu!',
            'tahun_academics_id.required' => 'Silahkan isi Tahun Akademik terlebih dahulu!',
            'program_studies_id.required' => 'Silahkan isi Program Studi terlebih dahulu!',
            'mata_kuliah_id.required' => 'Silahkan isi Mata Kuliah terlebih dahulu!'
        ]);

        $data = DosenMatkul::find($id);
        $data->update([
            'dosen_id' => $request->dosen_id,
            'tahun_academics_id' => $request->tahun_academics_id,
            'program_studies_id' => $request->program_studies_id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
        ]);

        return redirect()->route('dsnmatkul')->with([
            'success' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $data = DosenMatkul::find($id);
        $data->delete();

        return redirect()->route('dsnmatkul')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
