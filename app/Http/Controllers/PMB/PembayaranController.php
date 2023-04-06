<?php

namespace App\Http\Controllers\PMB;

use App\Models\User;
use App\Models\Timeline;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        
        $user = User::where('roles_id', '4')->get();
        $Pendaftaran = Pendaftaran::all();
        $Pembayaran = Pembayaran::all();
        return view('dashboard.master.pembayaran.index', compact('user', 'Pendaftaran', 'Pembayaran'));
    }


    public function verifikasipembayaran($id_pembayaran){
        //$dataUser = ProfileUsers::all();
        Pembayaran::where("id_pembayaran", "$id_pembayaran")->update([
            'status' => "Dibayar"
        ]);

        Timeline::create([
            'user_id' => Auth::user()->id,
            'status' => "Pembayaran",    
            'pesan' => 'Memperbaharui Status Pembayaran (Dibayar)',
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/pembayaran');
    }

    public function belumbayar($id_pembayaran){
        //$dataUser = ProfileUsers::all();
        Pembayaran::where("id_pembayaran", "$id_pembayaran")->update([
            'status' => "Belum Bayar"
        ]);

        Timeline::create([
            'user_id' => Auth::user()->id,
            'status' => "Pembayaran",    
            'pesan' => 'Memperbaharui Status Pembayaran (Belum Bayar)',
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/pembayaran');
    }

    public function invalidbayar($id_pembayaran){
        //$dataUser = ProfileUsers::all();
        Pembayaran::where("id_pembayaran", "$id_pembayaran")->update([
            'status' => "Tidak Sah"
        ]);

        Timeline::create([
            'user_id' => Auth::user()->id,
            'status' => "Pembayaran",    
            'pesan' => 'Memperbaharui Status Pembayaran (Tidak Sah)',
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/pembayaran');
    }

    public function destroy($id){
        $pembayaran = Pembayaran::find($id);
        $pembayaran->delete();
        Timeline::create([
            'user_id' => Auth::user()->id,
            'status' => "Pembayaran",    
            'pesan' => 'Menghapus Data Pembayaran',
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/pembayaran');
    }
}
