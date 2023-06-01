<?php

namespace App\Http\Controllers\PMB;


use file;
use App\Models\User;
use App\Models\Timeline;
use App\Models\Pembayaran;
use App\Models\Pengumuman;
use App\Models\jadwal_pmbs;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\Program_studies;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PendaftaranCambaController extends Controller
{
    public function index(){
        // dd(Auth::user()->toArray());
        $pendafatran = Pendaftaran::where('users_id', Auth::user()->id)->first();
        if ($pendafatran) {
            return view('dashboard.PMB.pendaftaran.data-pendaftaran-detail', ['x' => $pendafatran]);
        }

        $dataprod = Program_studies::all();
        $datenow = date('Y-m-d');
        $dataJadwal = jadwal_pmbs::where('tgl_mulai', '<=', $datenow)->where("tgl_akhir",">",$datenow)->get();

        return view ('dashboard.PMB.pendaftaran.index',[
            'viewDataJadwal' => $dataJadwal,
            'viewProdi' => $dataprod,
            // 'pendafatran' => $pendafatran
        ]);
    }

    public function simpanpendaftaran(Request $request)
    {
        // dd($request->all());

        $dataUser = User::all();

        $kodependaftaran = Pendaftaran::id();

        if ($request->hasFile('pas_foto')){
            $pathFoto = $request->file('pas_foto')->store('public/pendaftaran/foto');
        } else {
            $pathFoto = null;
        }
    
        if ($request->hasFile('berkas_ortu')) {
            $pathOrtu = $request->file('berkas_ortu')->store('public/pendaftaran/berkasortu');
        } else {
            $pathOrtu = null;
        }
    
        if ($request->hasFile('berkas_siswa') ) {
            $pathSiswa = $request->file('berkas_siswa')->store('public/pendaftaran/berkassiswa');
        } else {
            $pathSiswa = null;
        }
    
        if ($request->hasFile('prestasi')) {
            $pathPrestasi = $request->file('prestasi')->store('public/pendaftaran/berkasprestasi');
        } else {
            $pathPrestasi = null;
        }

        Pendaftaran::create([
            'id_pendaftaran' => $kodependaftaran,
            'users_id' => Auth::user()->id,
            'nisn' => $request->nisn,
            'nik' => $request->nik,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pas_foto' => $pathFoto,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,

            'email' => $request->email,
            'no_hp' => $request->no_hp,
            
            'alamat' => $request->alamat,

            //pendaftaran
            'jadwal_pmbs_id' => $request->jadwal_pmbs_id,
            'tahun_masuk' => now(),
            'pil1' => $request->pil1,
            'pil2' => $request->pil2,
            
            //ayahibu
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            //pendidikan
            'nohp_ayah' => $request->nohp_ayah,
            'nohp_ibu' => $request->nohp_ibu,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'penghasilan_ibu' => $request->penghasilan_ibu,
            'berkas_ortu' =>  $pathOrtu,

            'asal_sekolah' => $request->asal_sekolah,
            'smt1' => $request->smt1,
            'smt2' => $request->smt2,
            'smt3' => $request->smt3,
            'smt4' => $request->smt4,
            'smt5' => $request->smt5,
            'smt6' => $request->smt6,
            'berkas_siswa' => $pathSiswa,
            'prestasi' => $pathPrestasi,
            
            'status_pendaftaran' => 'Belum Terverifikasi',
            'tgl_pendaftaran' => now(),
            'created_at' => now()
        ]);

        $pendaftaranbaru = Pendaftaran::orderBy('id','DESC')->first();
        $id_pendaftaran = $pendaftaranbaru->id;
        
        //tambah insert
        $kodepembayaran = Pembayaran::id();
        echo $kodepembayaran;
        Pembayaran::create([
            'id_pembayaran' => $kodepembayaran,
            //'bukti_pembayaran' => "NULL",
            'status'=> "Belum Bayar",
            'verifikasi'=> false,
            'jatuh_tempo'  => now()->addDays(2)->format('Y-m-d'),
            'tgl_pembayaran' => now(),
            'id_pendaftaran' =>$id_pendaftaran,
            'created_at' => now()
        ]);

        $kodepengumuman = Pengumuman::id();
        Pengumuman::create([
            'id_pengumuman' => $kodepengumuman,
            'id_pendaftaran' => $id_pendaftaran,
            'users_id' => Auth::user()->id,
            'hasil_seleksi' => "Belum Seleksi",
            // 'status' => '0',
        ]);

        Timeline::create([
            'users_id' => Auth::user()->id,
            'status' => "Pendaftaran",    
            'pesan' => "Melakukan pendaftaran penerimaan mahasiswa baru",
            'tgl_update' => now(),
            'created_at' => now()
        ]);

        return redirect()->back()->with([
            'success' => 'Pendaftaran Berhasil',
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
        return view('dashboard.PMB.pendaftaran.pendaftaran-detail', [
            'User' => $User,
            'viewDataPembayaran' => $datPembayaran,
            'viewData' => $data,
            'viewProdi' => $dataprod
        ]);
    }

    public function kartupendaftaran($id_pendaftaran)
    {
        $User = User::all();
        $dataprod = Program_studies::all();
        $data = Pendaftaran::find($id_pendaftaran);
        return view('dashboard.PMB.pendaftaran.data-pendaftaran-kartu', [
            'User' => $User,
            'viewData' => $data,
            'viewProdi' => $dataprod
        ]);
    }

    public function lihatkelulusan(Request $a)
    {
        $user = User::where('roles_id', '4')->get();
        $dataditemukan = Pengumuman::where("id_pendaftaran", $a->id_pendaftaran)->first();
        $data = Pengumuman::all();
        $dataid = Pendaftaran::where("id_pendaftaran", $a->id_pendaftaran)->first();
        return view('dashboard.PMB.Pengumuman.index', compact('user', 'data', 'dataditemukan', 'dataid'));
    }
}
