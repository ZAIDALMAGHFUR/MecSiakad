<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\StrJabatan;
use App\Models\StrukturKepemimpinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturKepemimpinanController extends Controller
{
    public function index(Request $request)
    {
        $strukturKps = StrukturKepemimpinan::query()
            ->with('jabatan')
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.master.struktur-kps.index', compact('strukturKps'));
    }

    public function add()
    {
        $jabatans = StrJabatan::orderBy('name', 'asc')->get();
        return view('dashboard.master.struktur-kps.add', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'jabatan_id' => 'required|numeric',
            'name' => 'required',
            'description' => 'sometimes|max:1000|nullable',
            'pas_foto' => 'required|image|max:5000'
        ], [
            'jabatan_id.required'   => 'Silahkan pilih Jabatan terlebih dahulu!',
            'pas_foto.required' => 'Silahkan pilih Pas Foto terlebih dahulu!',
            'name.required' => 'Silahkan isi Nama terlebih dahulu!',
        ]);

        //create post
        StrukturKepemimpinan::create(array_merge(
            [
                'jabatan_id'     => $validatedData['jabatan_id'],
                'name'     => $validatedData['name'],
                'description'     => $validatedData['description'],
            ],
            $request->hasFile('pas_foto') ?
                ['pas_foto' => $request->file('pas_foto')->store('pas_fotos', ['disk' => 'public'])] : []
        ));

        return redirect()->route('struktur-kps.index')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }



    public function edit($id)
    {
        $jabatans = StrJabatan::orderBy('name', 'asc')->get();
        $data = StrukturKepemimpinan::findOrFail($id);
        return view('dashboard.master.struktur-kps.edit', compact('data', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        $strukturKp = StrukturKepemimpinan::findOrFail($id);

        $validatedData = $this->validate($request, [
            'jabatan_id' => 'required|numeric',
            'name' => 'required',
            'description' => 'sometimes|max:1000|nullable',
            'pas_foto' => 'sometimes|image|max:5000|nullable'
        ], [
            'jabatan_id.required'   => 'Silahkan pilih Jabatan terlebih dahulu!',
            'pas_foto.required' => 'Silahkan pilih Pas Foto terlebih dahulu!',
            'name.required' => 'Silahkan isi Nama terlebih dahulu!',
        ]);

        $strukturKp->update([
            'jabatan_id'     => $validatedData['jabatan_id'],
            'name'     => $validatedData['name'],
            'description'     => $validatedData['description'],
            'pas_foto' => $this->uploadOrReturnDefault('pas_foto', $strukturKp->pas_foto, 'pas_fotos'),
        ]);

        return redirect()->route('struktur-kps.index')->with([
            'success' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);
    }


    public function destroy($id)
    {
        $strukturKp = StrukturKepemimpinan::findOrFail($id);

        Storage::disk('public')->delete($strukturKp->pas_foto);
        $strukturKp->delete();

        return redirect()->route('struktur-kps.index')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
