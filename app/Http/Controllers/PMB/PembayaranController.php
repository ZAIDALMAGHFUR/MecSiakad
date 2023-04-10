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
        return redirect('/pembayaran')->with([
            'success' => 'Data Pembayaran Berhasil Diverifikasi',
            'alert-type' => 'success'
        ]);
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
        return redirect('/pembayaran')->with([
            'info' => 'Data Pembayaran Belum Diverifikasi',
            'alert-type' => 'success'
        ]);
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
        return redirect('/pembayaran')->with([
            'error' => 'Data Pembayaran Tidak Sah',
            'alert-type' => 'success'
        ]);
    }

    public function updatebuktipembayaran(Request $a){
        //$dataUser = ProfileUsers::all();
        try{
            $file = $a->file('pem');
            if(file_exists($file)){
                $kodependaftaran = $a->id_pendaftaran;
                $nama_file = "payment-".time()."-".$file->getClientOriginalName();
                $namaFolder = 'data pendaftar/'.$kodependaftaran;
                $file->move($namaFolder,$nama_file);
                $pathBukti = $namaFolder."/".$nama_file;
            } else {
                $pathBukti = null;
            }
            $id= Pendaftaran::where("id_pendaftaran", $a->id_pendaftaran)->first();
                    Pembayaran::where("id_pendaftaran", $id->id)->update([
                        'bukti_pembayaran' => $pathBukti,
                        'status'=> "Dibayar",
                    ]);
                    Timeline::create([
                        'user_id' => Auth::user()->id,
                        'status' => "Pembayaran",    
                        'pesan' => 'Mengunggah Bukti Pembayaran',
                        'tgl_update' => now(),
                        'created_at' => now()
                    ]);
            
            return redirect('/detail-registration'.'/'.$a->id_pendaftaran)->with([
                'success' => 'Data Berhasil Diubah!',
                'alert' => 'alert-success'
            ]);

        } catch (\Exception $e){
            return redirect()->back()->with([
                'success' => 'Data Gagal Diubah!',
                'alert' => 'alert-danger'
            ]);
        }
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
        return redirect('/pembayaran')->with([
            'success' => 'Data Berhasil Dihapus!',
            'alert' => 'alert-success'
        ]);
    }
}
