<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Dosen;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use Barryvdh\DomPDF\Facade\Pdf;
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
        'judul_acc' => 'required',
        'status'     => 'required',
        'pesan'     => 'required',
    ], [
        'judul_acc.required'   => 'Silahkan isi judul terlebih dahulu!',
        'status.required' => 'Silahkan isi status terlebih dahulu!',
        'pesan.required' => 'Silahkan isi pesan terlebih dahulu!',
    ]);

    //update data
    $pengajuan = Pengajuan::find($id);
    $pengajuan->update([
        'judul_acc' => $request->judul_acc,
        'status' => $request->status,
        'pesan' => $request->pesan,
    ]);

    return redirect()->back()->with([
        'success' => 'Pengajuan successfully changed!',
        'alert-type' => 'success'
    ]);
}

public function ambiljudul($mahasiswa_id, $name)
{
    // mengambil data pengajuan yang dimiliki oleh mahasiswa yang sedang login
    $pengajuan = Pengajuan::where('mahasiswa_id', $mahasiswa_id)->get();
    // dd($pengajuan);
    //mengambil data tahun akademik yang aktif
    $tahun_akademik = TahunAcademic::where('status', 'aktif')->first();

    $download ='Judul Skripsi-'. $name .'.pdf';
    // return view('dashboard.mahasiswa.khs.cetak.cetak', compact('data', 'ketua_prodi_id', 'nilai_akhirs', 'select_krs', 'total_sks', 'total_nilai', 'ipk'));
    return Pdf::loadHTML(view('dashboard.mahasiswa.pengajuan.surat', compact('pengajuan', 'tahun_akademik')))->download($download);
}

}
