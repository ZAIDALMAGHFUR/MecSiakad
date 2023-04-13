<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanDosenController extends Controller
{
    public function index()
    {
        $data = Jabatan::all();
        return view('dashboard.master.jabatan-dosen.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_jabatan' => 'required',
            'kode_jabatan'     => 'required',
        ], [
            'nama_jabatan.required'   => 'Silahkan isi nama jabatan terlebih dahulu!',
            'kode_jabatan.required' => 'Silahkan isi kode jabatan terlebih dahulu!',
        ]);

        //create post
        Jabatan::create([
            'nama_jabatan'     => $request->nama_jabatan,
            'kode_jabatan'     => $request->kode_jabatan,
        ]);

        return response()->json([
            'success' => 'Jabatan Dosen successfully added',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $data = Jabatan::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'nama_jabatan' => 'required',
            'kode_jabatan'     => 'required',
        ], [
            'nama_jabatan.required'   => 'Silahkan isi nama jabatan terlebih dahulu!',
            'kode_jabatan.required' => 'Silahkan isi kode jabatan terlebih dahulu!',
        ]);


        $data = Jabatan::find($id);
        $data->nama_jabatan = $request->nama_jabatan;
        $data->kode_jabatan = $request->kode_jabatan;
        $data->save();

        return response()->json([
            'success' => 'Jabatan Dosen successfully updated',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        if ($id == 1) {
            return redirect()->route('jabatan')->with([
                'error' => 'Gabisa dihapus Bro',
                'alert-type' => 'error'
            ]);
        }
        $data = Jabatan::find($id);
        $data->delete();

        return redirect()->route('jabatan')->with([
            'success' => 'Jabatan Dosen successfully deleted',
            'alert-type' => 'success'
        ]);
    }
}
