<?php

namespace App\Http\Controllers\PMB;


use App\Models\jadwal_pmbs;
use App\Models\Program_studies;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(){
        $dataprod = Program_studies::all();
        $datenow = date('Y-m-d');
        $dataJadwal = jadwal_pmbs::where('tgl_mulai', '<=', $datenow)->where("tgl_akhir",">",$datenow)->get();

        // dd($dataJadwal);
        return view ('dashboard.PMB.pendaftaran.index',[
            'viewDataJadwal' => $dataJadwal,
            'viewProdi' => $dataprod
        ]);
    }
}
