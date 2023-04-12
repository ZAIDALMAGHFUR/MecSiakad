<?php

namespace App\Http\Controllers\Admin;

use App\Models\BobotNilai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BobotNilaiController extends Controller
{
    public function index()
    {
        $data = BobotNilai::all();
        return view('dashboard.master.rentang-nilai.index', compact('data'));
    }

    public function add (Request $request)
    {
        $data = BobotNilai::all();
        return view('dashboard.master.rentang-nilai.add', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_rentang_nilai' => 'required',
            'rentang_nilai' => 'required',
            'huruf_nilai' => 'required',
            'bobot_nilai' => 'required',
        ], [
            'nama_rentang_nilai.required' => 'Silahkan isi nilai nama terlebih dahulu!',
            'rentang_nilai.required' => 'Silahkan isi nilai maksimal terlebih dahulu!',
            'huruf_nilai.required' => 'Silahkan isi Huruf Nilai  terlebih dahulu!',
            'bobot_nilai.required' => 'Silahkan isi bobot terlebih dahulu!',
        ]);


        $data = BobotNilai::create([
            'nama_rentang_nilai' => $request->nama_rentang_nilai,
            'rentang_nilai' => $request->rentang_nilai,
            'huruf_nilai' => $request->huruf_nilai,
            'bobot_nilai' => $request->bobot_nilai,
        ]);

        return redirect()->route('rentang')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $data = BobotNilai::find($id);
        return view('dashboard.master.rentang-nilai.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $bobot = BobotNilai::find($id);

        $this->validate($request, [
            'nama_rentang_nilai' => 'required',
            'rentang_nilai' => 'required',
            'huruf_nilai' => 'required',
            'bobot_nilai' => 'required',
        ], [
            'nama_rentang_nilai.required' => 'Silahkan isi nilai nama terlebih dahulu!',
            'rentang_nilai.required' => 'Silahkan isi nilai maksimal terlebih dahulu!',
            'huruf_nilai.required' => 'Silahkan isi Huruf Nilai  terlebih dahulu!',
            'bobot_nilai.required' => 'Silahkan isi bobot terlebih dahulu!',
        ]);

        $bobot->update([
            'nama_rentang_nilai' => $request->nama_rentang_nilai,
            'rentang_nilai' => $request->rentang_nilai,
            'huruf_nilai' => $request->huruf_nilai,
            'bobot_nilai' => $request->bobot_nilai,
        ]);

        return redirect()->route('rentang')->with([
            'info' => 'Data berhasil diubah',
            'alert-type' => 'info'
        ]);
    }

    public function destroy($id)
    {
        $bobot = BobotNilai::find($id);
        $bobot->delete();

        return redirect()->route('rentang')->with([
            'info' => 'Data berhasil dihapus',
            'alert-type' => 'info'
        ]);
    }
}
