<?php

namespace App\Http\Controllers\PMB;

use App\Models\User;
use App\Models\Timeline;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use App\Models\Program_studies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PendaftarController extends Controller
{
    public function index()
    {
        
        $user = User::where('roles_id', '4')->get();
        $Pendaftaran = Pendaftaran::all();
        return view('dashboard.master.pendaftar.index', compact('user', 'Pendaftaran'));
    }

    public function verifikasistatuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Terverifikasi"
        ]);
        Timeline::create([
            // 'user_id' => Auth::user()->id,
            'status' => "Pendaftaran",    
            'pesan' => "Melakukan verifikasi pendaftaran ".$id_pendaftaran,
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/pendaftar')->with([
            'success' => 'Data Berhasil Diverifikasi',
            'alert-type' => 'success'
        ]);
    }

    public function notverifikasistatuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Belum Terverifikasi"
        ]);
        Timeline::create([
            // 'user_id' => Auth::user()->id,
            'status' => "Pendaftaran",    
            'pesan' => "Melakukan perubahan verifikasi pendaftaran ".$id_pendaftaran." (Belum Terverifikasi)",
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/pendaftar')->with([
            'info' => 'Data Belum Diverifikasi',
            'alert-type' => 'success'
        ]);
    }

    public function invalidstatuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Tidak Sah"
        ]);
        Timeline::create([
            // 'user_id' => Auth::user()->id,
            'status' => "Pendaftaran",    
            'pesan' => "Melakukan perubahan verifikasi pendaftaran ".$id_pendaftaran." (Tidak Sah)",
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/pendaftar')->with([
            'error' => 'Data Tidak Sah',
            'alert-type' => 'success'
        ]);
    }

    public function selesaistatuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Selesai"
        ]);
        Timeline::create([
            // 'user_id' => Auth::user()->id,
            'status' => "Pendaftaran",    
            'pesan' => "Melakukan perubahan verifikasi pendaftaran ".$id_pendaftaran." (Umumkan)",
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/pendaftar')->with([
            'success' => 'Data Berhasil Di Umumkan',
            'alert-type' => 'success'
        ]);
    }

    public function detailpendaftaran($id_pendaftaran)
    {
        $User = User::all();
        $dataprod = Program_studies::all();
        $data = Pendaftaran::where("id_pendaftaran",$id_pendaftaran)->first();
        $datPembayaran = Pembayaran::where("id_pendaftaran",$data->id)->first();
        $no=1;
        
        
        $datapembayaran = Pendaftaran::where("id_pendaftaran", $id_pendaftaran)->get();
        return view('    dashboard.master.pendaftar.data-pendaftaran-detail', [
            'User' => $User,
            'viewDataPembayaran' => $datPembayaran,
            'viewData' => $data,
            'viewProdi' => $dataprod
        ]);
    }

    public function destroy($id){
        $Pendaftaran = Pendaftaran::find($id);
        $Pendaftaran->delete();
        return redirect()->back()->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
