<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mata_Kuliah;
use App\Models\Program_studies;
use Illuminate\Http\Request;

class MatkulController extends Controller
{public function index(Request $request)
{
    $program_studies = Program_studies::all();

    $matkul = Mata_Kuliah::query()
        ->when($request->input('program_studies_id'), function ($query, $program_studies_id) {
            return $query->where('program_studies_id', $program_studies_id);
        })
        ->orderBy('id', 'desc')
        ->get();

    return view('dashboard.master.matkul.index', compact('program_studies', 'matkul'));
}

    public function add(){
        $program_studies = Program_studies::all();
        return view('dashboard.master.matkul.add', compact('program_studies'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'name_mata_kuliah' => 'required',
            'sks'    => 'required',
            'semester'    => 'required',
            'program_studies_id'    => 'required'
        ], [
            'name_mata_kuliah.required'   => 'Silahkan isi Nama Mata Kuliah terlebih dahulu!',
            'sks.required' => 'Silahkan isi sks terlebih dahulu!',
            'semester.required' => 'Silahkan isi status terlebih dahulu!',
            'program_studies_id.required' => 'Silahkan isi Program Studi terlebih dahulu!'
        ]);
    
        $program_studies = Program_Studies::find($request->program_studies_id);
        $program_studies_code = substr($program_studies->name, 0, 1);
    
        $last_matkul = Mata_Kuliah::orderBy('id', 'desc')->first();
        $last_matkul_code = $last_matkul ? $last_matkul->kode_mata_kuliah : '';
    
        $name_mata_kuliah = $request->name_mata_kuliah;
        $name_mata_kuliah_array = explode(' ', $name_mata_kuliah);
        $name_mata_kuliah_first_letter = substr($name_mata_kuliah_array[0], 0, 1);
        if (isset($name_mata_kuliah_array[1])) {
            $name_mata_kuliah_second_word_first_letter = substr($name_mata_kuliah_array[1], 0, 1);
        } else {
            $name_mata_kuliah_second_word_first_letter = '';
        }
        
    
        $kode_mata_kuliah = $program_studies_code . $name_mata_kuliah_first_letter . $name_mata_kuliah_second_word_first_letter . str_pad($last_matkul_code ? substr($last_matkul_code, -3) + 1 : 1, 3, '0', STR_PAD_LEFT);
    
        //create post
        Mata_Kuliah::create([
            'name_mata_kuliah'     => $request->name_mata_kuliah,
            'kode_mata_kuliah'     => $kode_mata_kuliah,
            'sks'     => $request->sks,
            'semester'     => $request->semester,
            'program_studies_id'     => $request->program_studies_id,
        ]);
    
        return redirect()->route('matkul')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }
    
    

    public function edit($id){
        $data = Mata_Kuliah::findOrFail($id);
        $program_studies = Program_studies::all();
        return view('dashboard.master.matkul.edit', compact('data', 'program_studies'));
    }

    public function update(Request $request, $id){
        $matkul = Mata_Kuliah::findOrFail($id);
    
        $this->validate($request, [
            'name_mata_kuliah' => 'required',
            'sks'    => 'required',
            'semester'    => 'required',
            'program_studies_id'    => 'required'
        ], [
            'name_mata_kuliah.required'   => 'Silahkan isi Nama Mata Kuliah terlebih dahulu!',
            'sks.required' => 'Silahkan isi sks terlebih dahulu!',
            'semester.required' => 'Silahkan isi status terlebih dahulu!',
            'program_studies_id.required' => 'Silahkan isi Program Studi terlebih dahulu!'
        ]);
    
        $program_studies = Program_Studies::find($request->program_studies_id);
        $program_studies_code = substr($program_studies->name, 0, 1);
    
        $name_mata_kuliah = $request->name_mata_kuliah;
        $name_mata_kuliah_array = explode(' ', $name_mata_kuliah);
        $name_mata_kuliah_first_letter = substr($name_mata_kuliah_array[0], 0, 1);
        $name_mata_kuliah_second_word_first_letter = substr($name_mata_kuliah_array[1], 0, 1);
    
        $last_matkul = Mata_Kuliah::orderBy('id', 'desc')->first();
        $last_matkul_code = $last_matkul ? $last_matkul->kode_mata_kuliah : '';
    
        $kode_mata_kuliah = $program_studies_code . $name_mata_kuliah_first_letter . $name_mata_kuliah_second_word_first_letter . str_pad($last_matkul_code ? substr($last_matkul_code, -3) + 1 : 1, 3, '0', STR_PAD_LEFT);
    
        $matkul->update([
            'name_mata_kuliah'     => $request->name_mata_kuliah,
            'kode_mata_kuliah'     => $kode_mata_kuliah,
            'sks'     => $request->sks,
            'semester'     => $request->semester,
            'program_studies_id'     => $request->program_studies_id,
        ]);
    
        return redirect()->route('matkul')->with([
            'success' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);
    }
    

    public function destroy($id){
        $matkul = Mata_Kuliah::findOrFail($id);
        $matkul->delete();

        return redirect()->route('matkul')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
