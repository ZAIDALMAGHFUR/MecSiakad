<?php

namespace App\Http\Controllers\PMB;

use App\Models\Persyaratans;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersyaratanController extends Controller
{
    public function index()
    {
        $persyaratan = Persyaratans::all();
        return view('dashboard.master.persyaratan.index', compact('persyaratan'));
    }

    public function add()
    {
        return view('dashboard.master.persyaratan.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jalur_prestasi' => 'required',
            'jalur_beasiswa' => 'required',
            'jalur_pindahan' => 'required',
            'jalur_reguler' => 'required',
        ]);

        Persyaratans::create([
            'jalur_prestasi' => $request->jalur_prestasi,
            'jalur_beasiswa' => $request->jalur_beasiswa,
            'jalur_pindahan' => $request->jalur_pindahan,
            'jalur_reguler' => $request->jalur_reguler,
        ]);

        return redirect()->route('persyaratan')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id){

        $persyaratan = Persyaratans::findOrFail($id);
        return view('dashboard.master.persyaratan.edit', compact('persyaratan'));
    }

    public function update(Request $request, $id){
        $persyaratan = Persyaratans::findOrFail($id);

        $this->validate($request, [
            'jalur_prestasi' => 'required',
            'jalur_beasiswa' => 'required',
            'jalur_pindahan' => 'required',
            'jalur_reguler' => 'required',
        ]);

        $persyaratan->update([
            'jalur_prestasi' => $request->jalur_prestasi,
            'jalur_beasiswa' => $request->jalur_beasiswa,
            'jalur_pindahan' => $request->jalur_pindahan,
            'jalur_reguler' => $request->jalur_reguler,
        ]);
        
        return redirect()->route('persyaratan')->with([
            'success' => 'Data berhasil di Ubah',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id){
        $Persyaratans = Persyaratans::findOrFail($id);
        $Persyaratans->delete();

        return redirect()->route('persyaratan')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
