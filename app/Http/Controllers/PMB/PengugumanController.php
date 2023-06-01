<?php

namespace App\Http\Controllers\PMB;

use App\Models\User;
use App\Models\Timeline;
use App\Models\Pengumuman;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\Program_studies;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PengugumanController extends Controller
{
    public function index()
    {
        
        $user = User::where('roles_id', '4')->get();
        $Pengumuman = Pengumuman::all();
        $Pendaftaran = Pendaftaran::all();
        $Program_studies = Program_studies::all();
        return view('dashboard.master.penguguman.index', compact('user', 'Pengumuman', 'Pendaftaran', 'Program_studies'));
    }

    public function lihatpengumuman(Request $a)
    {
        $user = User::where('roles_id', '4')->get();
        $dataditemukan = Pengumuman::where("id_pendaftaran", $a->id_pendaftaran)->first();
        $data = Pengumuman::all();
        $dataid = Pendaftaran::where("id_pendaftaran", $a->id_pendaftaran)->first();
        return view ('dashboard.master.penguguman.data-pengumuman-view', compact('user', 'data', 'dataditemukan', 'dataid'));
    }


    public function simpanpengumuman(Request $a)
    {
        try{
            // dd($a->all());
        //$dataUser = ProfileUsers::all();
            $kode = Pengumuman::id();
            Pengumuman::create([
                'id_pengumuman' => $kode,
                'id_pendaftaran' => $a->id_pendaftaran,
                'users_id' => $a,
                'hasil_seleksi' => $a->hasil,
                'prodi_penerima' => $a->penerima,
                'nilai_interview' => $a->interview,
                'nilai_test' => $a->test
            ]);
            Timeline::create([
                'user_id' => Auth::user()->id,
                'status' => "Pengumuman",    
                'pesan' => 'Membuat Pengumuman',
                'tgl_update' => now(),
                'created_at' => now()
            ]);
            return redirect('/data-announcement')->with([
                'success' => 'Data Berhasil Disimpan',
                'alert-type' => 'success']);
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Disimpan!');
        }
    }

    public function updatepengumuman(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'hasil_seleksi' => 'required',
            'nilai_interview' => 'required',
            'nilai_test' => 'required',
        ], [
            'hasil_seleksi.required' => 'Hasil Seleksi tidak boleh kosong!',
            'nilai_interview.required' => 'Nilai Interview tidak boleh kosong!',
            'nilai_test.required' => 'Nilai Test tidak boleh kosong!',
        ]);

        $pengumuman = Pengumuman::find($id);
        $pengumuman->update([
            'hasil_seleksi' => $request->hasil_seleksi,
            'prodi_penerima' => $request->prodi_penerima,
            'nilai_interview' => $request->nilai_interview,
            'nilai_test' => $request->nilai_test,
        ]);

        Timeline::create([
            'status' => "Pengumuman",    
            'pesan' => 'Mengubah Pengumuman',
            'tgl_update' => now(),
            'created_at' => now()
        ]);

        return redirect()->back()->with([
            'success' => 'Data berhasil diubah!',
            'alert-type' => 'success'
        ]);
    }
    
    
}
