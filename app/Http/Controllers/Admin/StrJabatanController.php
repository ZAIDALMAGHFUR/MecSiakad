<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrJabatan;
use App\Models\Mata_Kuliah;
use App\Models\Program_studies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrJabatanController extends Controller
{
    public function index(Request $request)
    {
        $jabatans = StrJabatan::query()
            ->get()->each(function ($jabatan) {
                $jabatan['parent'] = StrJabatan::where('id', $jabatan->child_of)->get()->first()?->name == null ? 'none' : StrJabatan::where('id', $jabatan->child_of)->get()->first()?->name;
            });

            // dd($jabatans->toArray());

        return view('dashboard.master.jabatans.index', compact('jabatans'));
        // return response()->json($jabatans);
    }

    public function add()
    {
        $jabatans = StrJabatan::query()
        ->get();

        return view('dashboard.master.jabatans.add', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required',
            'child_of'    => 'required|numeric',
        ], [
            'name.required'   => 'Silahkan isi Nama Jabatan terlebih dahulu!',
            'child_of.required' => 'Silahkan isi \'Child of\' terlebih dahulu!',
        ]);

        //create post
        StrJabatan::create([
            'name'     => $validatedData['name'],
            'child_of'     => $validatedData['child_of'],
        ]);

        return redirect()->route('jabatans.index')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }



    public function edit($id)
    {
        $data = StrJabatan::findOrFail($id);
        return view('dashboard.master.jabatans.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $jabatan = StrJabatan::findOrFail($id);

        $validatedData = $this->validate($request, [
            'name' => 'required',
            'child_of'    => 'required|numeric',
        ], [
            'name.required'   => 'Silahkan isi Nama Jabatan terlebih dahulu!',
            'child_of.required' => 'Silahkan isi Urutan terlebih dahulu!',
        ]);

        $jabatan->update([
            'name'     => $validatedData['name'],
            'child_of'     => $validatedData['child_of'],
        ]);

        return redirect()->route('jabatans.index')->with([
            'success' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);
    }


    public function destroy($id)
    {
        StrJabatan::findOrFail($id)->delete();

        return redirect()->route('jabatans.index')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
