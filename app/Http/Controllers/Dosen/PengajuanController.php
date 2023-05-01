<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengajuanController extends Controller
{
    public function index()
    {   
        $Pengajuan = Pengajuan::all();
        return view('dashboard.dosen.pengajuan.index', compact('Pengajuan'));
    }

    public function update(Request $request, $id)
{
    $this->validate($request, [
        'judul' => 'required',
        'status'     => 'required',
        'pesan'     => 'required',
    ], [
        'judul.required'   => 'Silahkan isi judul terlebih dahulu!',
        'status.required' => 'Silahkan isi status terlebih dahulu!',
        'pesan.required' => 'Silahkan isi pesan terlebih dahulu!',
    ]);

    //update data
    $pengajuan = Pengajuan::find($id);
    $pengajuan->update([
        'judul' => $request->judul,
        'status' => $request->status,
        'pesan' => $request->pesan,
    ]);

    return redirect()->back()->with([
        'success' => 'Pengajuan successfully changed!',
        'alert-type' => 'success'
    ]);
}

}
