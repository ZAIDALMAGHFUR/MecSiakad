<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Krs;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\DosenMatkul;
use App\Models\DosenJabatan;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GetKHSController extends Controller
{
    public function index()
    {
        $mhs = Mahasiswa::Where('user_id', Auth::user()->id)
        ->first();
        $krs = Krs::where('nim', $mhs->nim)->get();
        $TahunAcademic = TahunAcademic::all();
        // dd($mhs);
        return view('dashboard.mahasiswa.khs.index', compact('TahunAcademic', 'krs', 'mhs'));
    }

    public function find(Request $request)
    {
        $this->validate(request(), [
            'tahun_academic_id' => 'required',
        ]);

        $mhs = Mahasiswa::Where('user_id', Auth::user()->id)
        ->first();
        $nim = $mhs->nim;

        // dd($mhs);

        $mhs = Mahasiswa::where('nim', $nim)->first();
        if(is_null($mhs)) {
            return redirect()->back()->with([
                'info' => 'mahasiswa belum terdaftar !',
                'alert-type' => 'info'
            ]);
        }

        $tahun_academic = TahunAcademic::findOrFail($request->tahun_academic_id);

        // dd($tahun_academic);
        $krs = Krs::where('nim', $mhs->nim)
        ->where('tahun_academic_id', $request->tahun_academic_id)
        ->get();

        if($krs->isEmpty()) {
            return redirect()->back()->with([
                'info' => 'Maaf, mahasiswa belum melakukan pemilihan KRS pada tahun akademik yang dipilih !',
                'alert-type' => 'info'
            ]);
        }

        $nilai_akhirs = Nilai::select('tahun_academic_id', 'mahasiswas_id', 'mata_kuliahs_id', 'nilai_akhir')
            ->where('mahasiswas_id', $mhs->id)
            ->where('tahun_academic_id', $request->tahun_academic_id)
            ->get();

            // dd($nilai_akhirs);
        if ($krs->count() != $nilai_akhirs->count()) {
            return redirect()->back()->with([
                'info' => 'Maaf, Nilai kamu belum selesai di isi !',
                'alert-type' => 'info'
            ]);
        }

        if($nilai_akhirs->isEmpty()) {
            return redirect()->back()->with([
                'info' => 'Mahasiswa belum memiliki nilai pada tahun yang dipilih !',
                'alert-type' => 'info'
            ]);
        }


        $select_krs = Krs::where('nim', $mhs->nim)
            ->where('tahun_academic_id', $request->tahun_academic_id)
            ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
            ->select('krs.id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
            ->get();

            // dd($select_krs->toArray());

        $data_khs = [
            'mhs_data' => $nilai_akhirs,
            'nim' => $mhs->nim,
            'name' => $mhs->name,
            'prody' => $mhs->program_studies->name,
            'tahun_academic' => $tahun_academic->tahun_akademik,
            'semester' => $tahun_academic->semester,
            'select_krs' => $select_krs,
        ];



        // Menambahkan perhitungan kriteria nilai akhir

        foreach ($nilai_akhirs as $nilai_akhir) {
            $nilai_akhir->kriteria = '';
            if ($nilai_akhir->nilai_akhir >= 0 && $nilai_akhir->nilai_akhir <= 59) {
                $nilai_akhir->kriteria = 'E';
            } elseif ($nilai_akhir->nilai_akhir >= 60 && $nilai_akhir->nilai_akhir <= 69) {
                $nilai_akhir->kriteria = 'D';
            } elseif ($nilai_akhir->nilai_akhir >= 70 && $nilai_akhir->nilai_akhir <= 79) {
                $nilai_akhir->kriteria = 'C';
            } elseif ($nilai_akhir->nilai_akhir >= 80 && $nilai_akhir->nilai_akhir <= 89) {
                $nilai_akhir->kriteria = 'B';
            } elseif ($nilai_akhir->nilai_akhir >= 90 && $nilai_akhir->nilai_akhir <= 100) {
                $nilai_akhir->kriteria = 'A';
            }
        }

    // dd($request->all());

        return view('dashboard.mahasiswa.khs.show', compact('data_khs', 'tahun_academic'));
    }


    public function cetak()
    {
        $mhsinfo = Mahasiswa::where('user_id', Auth::user()->id)->first();
        // dd($mhsinfo->protoNilai()->get()->toArray());
        $nim = $mhsinfo->nim;
        $data = (object)[];
        $data->mhs = Mahasiswa::where('nim', $nim)->first();
        $data->tahun_academic = TahunAcademic::all()->first();
        $data->tahun_akademik_id = $data->tahun_academic->id;
        $data->program_studies_id = $data->mhs->program_studies_id;
        $select_krs = Krs::where('nim', $nim)
        ->where('tahun_academic_id', $data->tahun_akademik_id)
        ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
        ->select('krs.id', 'krs.mata_kuliah_id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
        ->get();
        // dd(Nilai::all()->toArray());
        // dd($select_krs->toArray());

        $matkul = $select_krs->pluck('mata_kuliah_id');

        // dd($select_krs);

        $ketua_prodi_id = DosenJabatan::where('jabatan_id', 1)->where('program_studies_id', $data->program_studies_id)->first();

        $nilai_akhirs = Nilai::select('tahun_academic_id', 'mahasiswas_id', 'mata_kuliahs_id', 'nilai_akhir')
        ->where('mahasiswas_id', $mhsinfo->id)
        ->where('tahun_academic_id', $data->tahun_academic->id)
        ->get();
        // dd($nilai_akhirs->toArray());

        foreach ($nilai_akhirs as $nilai_akhir) {
            $nilai_akhir->kriteria = '';
            if ($nilai_akhir->nilai_akhir >= 0 && $nilai_akhir->nilai_akhir <= 59) {
                $nilai_akhir->kriteria = 'E';
            } elseif ($nilai_akhir->nilai_akhir >= 60 && $nilai_akhir->nilai_akhir <= 69) {
                $nilai_akhir->kriteria = 'D';
            } elseif ($nilai_akhir->nilai_akhir >= 70 && $nilai_akhir->nilai_akhir <= 79) {
                $nilai_akhir->kriteria = 'C';
            } elseif ($nilai_akhir->nilai_akhir >= 80 && $nilai_akhir->nilai_akhir <= 89) {
                $nilai_akhir->kriteria = 'B';
            } elseif ($nilai_akhir->nilai_akhir >= 90 && $nilai_akhir->nilai_akhir <= 100) {
                $nilai_akhir->kriteria = 'A';
            }

            $nilai_akhir->bobot = 0;
            if($nilai_akhir->kriteria == 'A'){
                $nilai_akhir->bobot = 4;
            } elseif($nilai_akhir->kriteria == 'B'){
                $nilai_akhir->bobot = 3;
            } elseif($nilai_akhir->kriteria == 'C'){
                $nilai_akhir->bobot = 2;
            } elseif($nilai_akhir->kriteria == 'D'){
                $nilai_akhir->bobot = 1;
            } elseif($nilai_akhir->kriteria == 'E'){
                $nilai_akhir->bobot = 0;
            }
        }

        $total_sks = 0 ;
        foreach ($select_krs as $sks) {
            $total_sks += $sks->sks;
        }

        $total_nilai = 0;
        // dd($select_krs);
        foreach ($select_krs as $index => $khs) {
            $bobot = $nilai_akhirs[$index]->bobot;
            // dd($nilai_akhirs[$index]->bobot);
            // dd($khs->sks);
            $nilai = $khs->sks * $bobot;
            // dd($nilai);
            $total_nilai += $nilai;

        }
// dd("breakpoint");s
        $ipk = number_format($total_nilai / $total_sks, 2);

        $download ='KHS-'. $data->mhs->name .'.pdf';
        // return view('dashboard.mahasiswa.khs.cetak.cetak', compact('data', 'ketua_prodi_id', 'nilai_akhirs', 'select_krs', 'total_sks', 'total_nilai', 'ipk'));
        return Pdf::loadHTML(view('dashboard.mahasiswa.khs.cetak.cetak', compact('data', 'ketua_prodi_id', 'nilai_akhirs', 'select_krs', 'total_sks', 'total_nilai', 'ipk')))->download($download);
    }
}
