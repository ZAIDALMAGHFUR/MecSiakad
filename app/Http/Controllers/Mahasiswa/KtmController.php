<?php

namespace App\Http\Controllers\Mahasiswa;

use Dompdf\Dompdf;
use App\Models\selectedktms;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use App\Http\Controllers\Controller;

class KtmController extends Controller
{
    public function index(){
        $ktm = selectedktms::first();
        $mhs = auth()->user()->mahasiswa;
        $data = [
            'nama' => $mhs->name,
            'nim' => $mhs->nim,
            'prodi' => $mhs->program_studies->name,
            'foto' => $mhs->foto,
        ];
        // Browsershot::html(view('dashboard.master.ktm.' . $ktm->ktm_selected, compact( 'data'))->render())
        // ->setNodeBinary('PATH %~dp0;%PATH%;')
        // ->save('example.jpg');
        // return view('dashboard.master.ktm.' . $ktm->ktm_selected, compact( 'data'));

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('dashboard.master.ktm.' . $ktm->ktm_selected, compact( 'data'))->render());
        // $dompdf .= '<link type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">';
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
}
