<?php

namespace App\Http\Controllers\PMB;

use App\Models\User;
use App\Models\Timeline;
use App\Models\Pendaftaran;
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
        return redirect('/pendaftar');
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
        return redirect('/pendaftar');
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
        return redirect('/pendaftar');
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
        return redirect('/pendaftar');
    }
}
