<?php

namespace App\Http\Controllers;

use App\Models\DosenJabatan;
use Illuminate\Http\Request;
use App\Models\Program_studies;
use Illuminate\Support\Facades\Validator;

class ProgrammStudiController extends Controller
{

    public function index()
    {
        $data = Program_studies::all();
        return view('dashboard.master.Program-Studi.index', compact('data'));
    }

    public function add()
    {
        return view('dashboard.master.Program-Studi.add');
    }
    
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required|unique:program_studies',
            'kode_prodi' => 'required|unique:program_studies',
            'jenjang' => 'required:program_studies',
        ]);

        Program_studies::create([
            'name' => $request->name,
            'kode_prodi' => $request->kode_prodi,
            'jenjang' => $request->jenjang,
        ]);
    
        return redirect()->route('program-studi')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }
    

    public function edit($id)
    {
        $data = Program_studies::findOrFail($id);
        return view('dashboard.master.Program-Studi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:program_studies',
            'kode_prodi' => 'required|unique:program_studies',
            'jenjang' => 'required:program_studies',
        ]);

        $data = Program_studies::findOrFail($id);
        $data->update([
            'name' => $request->name,
            'kode_prodi' => $request->kode_prodi,
            'jenjang' => $request->jenjang,
        ]);

        return redirect()->route('program-studi')->with([
            'info' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $data = Program_studies::findOrFail($id);
    
        // Check if there are any rows in dosen_jabatans table that reference this row in program_studies table
        $is_referenced = DosenJabatan::where('program_studies_id', $id)->exists();
    
        if ($is_referenced) {
            return redirect()->route('program-studi')->with([
                'error' => 'Data tidak bisa dihapus karena masih ada data yang terkait',
                'alert-type' => 'error'
            ]);
        } else {
            $data->delete();
            return redirect()->route('program-studi')->with([
                'success' => 'Data berhasil dihapus',
                'alert-type' => 'success'
            ]);
        }
    }
    
}
