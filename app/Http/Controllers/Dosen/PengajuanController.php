<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Dosen;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index()
    {   
        $dosen = Dosen::Where('users_id', Auth::user()->id)->first();
        $pengajuan = Pengajuan::where('dosen_id', $dosen->id)->get();
        return view('dashboard.dosen.pengajuan.index', [
            'pengajuan' => $pengajuan
        ]);
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
