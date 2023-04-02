<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dosen;
use App\Models\Jabatan;
use App\Models\DosenJabatan;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Models\Program_studies;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DosenJabatanController extends Controller
{
    public function index(Request $request)
    {
        $data = DB::table('dosen_jabatans')
            ->join('dosens', 'dosen_jabatans.dosen_id', '=', 'dosens.id')
            ->join('jabatans', 'dosen_jabatans.jabatan_id', '=', 'jabatans.id')
            ->join('tahun_academics', 'dosen_jabatans.tahun_academics_id', '=', 'tahun_academics.id')
            ->join('program_studies', 'dosen_jabatans.program_studies_id', '=', 'program_studies.id')
            ->select('dosen_jabatans.*', 'dosens.nama_dosen', 'jabatans.nama_jabatan', 'tahun_academics.tahun_akademik', 'program_studies.name')
            ->get();
        return view('dashboard.master.dosen-jabatan.index', compact('data'));
    }

    public function add()
    {
        $dosen = Dosen::all();
        $jabatan = Jabatan::all();
        $tahun_academics = TahunAcademic::all();
        $program_studies = Program_studies::all();
        return view('dashboard.master.dosen-jabatan.add', compact('dosen', 'jabatan', 'tahun_academics', 'program_studies'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'dosen_id' => 'required',
            'jabatan_id' => 'required',
            'tahun_academics_id' => 'required',
            'program_studies_id' => 'required'
        ], [
            'dosen_id.required' => 'Silahkan isi Nama Dosen terlebih dahulu!',
            'jabatan_id.required' => 'Silahkan isi Jabatan terlebih dahulu!',
            'tahun_academics_id.required' => 'Silahkan isi Tahun Akademik terlebih dahulu!',
            'program_studies_id.required' => 'Silahkan isi Program Studi terlebih dahulu!'
        ]);

        //create post
        DosenJabatan::create([
            'dosen_id' => $request->dosen_id,
            'jabatan_id' => $request->jabatan_id,
            'tahun_academics_id' => $request->tahun_academics_id,
            'program_studies_id' => $request->program_studies_id,
        ]);

        return redirect()->route('dsnjabatan')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $data = DosenJabatan::findOrFail($id);
        $dosen = Dosen::all();
        $jabatan = Jabatan::all();
        $tahun_academics = TahunAcademic::all();
        $program_studies = Program_studies::all();
        return view('dashboard.master.dosen-jabatan.edit', compact('data', 'dosen', 'jabatan', 'tahun_academics', 'program_studies'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'dosen_id' => 'required',
            'jabatan_id' => 'required',
            'tahun_academics_id' => 'required',
            'program_studies_id' => 'required'
        ], [
            'dosen_id.required' => 'Silahkan isi Nama Dosen terlebih dahulu!',
            'jabatan_id.required' => 'Silahkan isi Jabatan terlebih dahulu!',
            'tahun_academics_id.required' => 'Silahkan isi Tahun Akademik terlebih dahulu!',
            'program_studies_id.required' => 'Silahkan isi Program Studi terlebih dahulu!'
        ]);

        $data = DosenJabatan::findOrFail($id);
        $data->update([
            'dosen_id' => $request->dosen_id,
            'jabatan_id' => $request->jabatan_id,
            'tahun_academics_id' => $request->tahun_academics_id,
            'program_studies_id' => $request->program_studies_id,
        ]);

        return redirect()->route('dsnjabatan')->with([
            'success' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $data = DosenJabatan::findOrFail($id);
        $data->delete();

        return redirect()->route('dsnjabatan')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
