<?php

namespace App\Http\Controllers\PMB;

use App\Models\jadwal_pmbs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalPmbController extends Controller
{
    public function index()
    {
        $datenow = date('Y-m-d');
        $jadwal_pmbs = jadwal_pmbs::all();
        return view('dashboard.master.jadwalpmb.index', compact('jadwal_pmbs', 'datenow'));
    }

    public function create()
    {
        return view('dashboard.master.jadwalpmb.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'tgl_mulai' => 'required',
            'tgl_akhir' => 'required',
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan tidak boleh kosong!',
            'jenis_kegiatan.required' => 'Jenis kegiatan tidak boleh kosong!',
            'tgl_mulai.required' => 'Tanggal mulai tidak boleh kosong!',
            'tgl_akhir.required' => 'Tanggal akhir tidak boleh kosong!',
        ]);

        jadwal_pmbs::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
        ]);

        return redirect()->route('jadwalpmb')->with([
            'success' => 'Data berhasil ditambahkan!',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $jadwal_pmbs = jadwal_pmbs::find($id);
        return response()->json($jadwal_pmbs);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'tgl_mulai' => 'required',
            'tgl_akhir' => 'required',
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan tidak boleh kosong!',
            'jenis_kegiatan.required' => 'Jenis kegiatan tidak boleh kosong!',
            'tgl_mulai.required' => 'Tanggal mulai tidak boleh kosong!',
            'tgl_akhir.required' => 'Tanggal akhir tidak boleh kosong!',
        ]);

        $jadwal_pmbs = jadwal_pmbs::find($id);
        $jadwal_pmbs->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
        ]);

        return redirect()->route('jadwalpmb')->with([
            'success' => 'Data berhasil diubah!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $jadwal_pmbs = jadwal_pmbs::find($id);
        $jadwal_pmbs->delete();

        return redirect()->route('jadwalpmb')->with([
            'success' => 'Data berhasil dihapus!',
            'alert-type' => 'success'
        ]);
    }
}
