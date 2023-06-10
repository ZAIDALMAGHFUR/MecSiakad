<?php

namespace App\Http\Controllers\Mahasiswa;

//use Dompdf\Dompdf;
use App\Models\selectedktms;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Services\TemplateProcessing;
// use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;

class KtmController extends Controller
{
    public function index(){
        $ktm = selectedktms::first();
        $mhs = auth()->user()->mahasiswa;
        $data = [
            'nama' => $mhs->name,
            'nim' => $mhs->nim,
            'prodi' => $mhs->program_studies->name,
            'foto' => auth()->user()->foto,
        ];

        if (empty(auth()->user()->foto)) {
            return redirect()->route('mahasiswa')->with([
                'info' => 'Tolong ganti dan lengkapi foto profil anda di tombol setting',
                'alert-type' => 'info'
            ]);
        }

        $template = new TemplateProcessing(base_path() . '/hayuk.docx');
        $template->setValues(array('NAMA' => $mhs->name, 'NIM' => $mhs->nim, 'PRODI' => $mhs->program_studies->name));
        $template->replaceImage('image1.jpeg', public_path() . Storage::url(auth()->user()->foto));
        $filename = public_path() . Storage::url("temp-ktm/" . Str::uuid());
        $template->saveAs($filename . '.docx');

        if (function_exists('shell_exec') && strtoupper(substr(PHP_OS, 0, 3)) != 'WIN') {
            shell_exec('export HOME=/tmp; libreoffice --headless --convert-to jpg --outdir ' . public_path() . Storage::url("temp-ktm/") . ' ' . $filename . '.docx');
            return response()->download($filename . '.jpg', 'KTM-'. $mhs->name . '.jpg');
        } else {
            return response()->download($filename . '.docx', 'KTM-'. $mhs->name . '.docx');
        }

    }
}
