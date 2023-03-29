<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mata_Kuliah;
use App\Models\Program_studies;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function index()
    {
        $data = Mata_Kuliah::all();
        return view('dashboard.master.matkul.index', compact('data'));
    }

    public function add(){
        $program_studies = Program_studies::all();
        return view('dashboard.master.matkul.add', compact('program_studies'));
    }

    public function store(Request $request){
    
        $this->validate($request, [
            'name_mata_kuliah' => 'required',
            'kode_mata_kuliah'     => 'required',
            'sks'    => 'required',
            'semester'    => 'required',
            'program_studies_id'    => 'required'
        ], [
            'name_mata_kuliah.required'   => 'Silahkan isi Nama Mata Kuliah terlebih dahulu!',
            'sks.required' => 'Silahkan isi sks terlebih dahulu!',
            'semester.required' => 'Silahkan isi status terlebih dahulu!',
            'program_studies_id.required' => 'Silahkan isi Program Studi terlebih dahulu!'
        ]);

        //create post
        Mata_Kuliah::create([
            'name_mata_kuliah'     => $request->name_mata_kuliah,
            'kode_mata_kuliah'     => $request->kode_mata_kuliah,
            'sks'     => $request->sks,
            'semester'     => $request->semester,
            'program_studies_id'     => $request->program_studies_id,
        ]);

        return redirect()->route('matkul.index')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }
}
