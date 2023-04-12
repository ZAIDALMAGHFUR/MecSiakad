<?php

namespace App\Http\Controllers\Admin;

use App\Models\Krs;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Http\Controllers\Controller;

class KhsController extends Controller
{
    public function index()
    {
        $TahunAcademic = TahunAcademic::all();
        return view('dashboard.master.khs.index', compact('TahunAcademic'));
    }

    public function find(Request $request)
    {
        $this->validate(request(), [
            'tahun_academic_id' => 'required',
            'nim' => 'required',
        ]);
    
        $mhs = Mahasiswa::where('nim', $request->nim)->first();
        if(is_null($mhs)) {
            return redirect()->back()->with([
                'info' => 'mahasiswa belum terdaftar !',
                'alert-type' => 'info'
            ]);
        }
    
        $tahun_academic = TahunAcademic::findOrFail($request->tahun_academic_id);
    
        $nilai_akhirs = Nilai::select('tahun_academic_id', 'mahasiswas_id', 'mata_kuliahs_id', 'nilai_akhir')
            ->where('mahasiswas_id', $mhs->id)
            ->where('tahun_academic_id', $request->tahun_academic_id)
            ->get();
    
        if($nilai_akhirs->isEmpty()) {
            return redirect()->back()->with([
                'info' => 'Mahasiswa belum memiliki nilai pada tahun yang dipilih !',
                'alert-type' => 'info'
            ]);
        }
    
        $krs = Krs::where('nim', $request->nim)
            ->where('tahun_academic_id', $request->tahun_academic_id)
            ->get();
    
        if($krs->isEmpty()) {
            return redirect()->back()->with([
                'info' => 'Maaf, mahasiswa belum melakukan pemilihan KRS pada tahun akademik yang dipilih !',
                'alert-type' => 'info'
            ]);
        }
    
        $select_krs = Krs::where('nim', $request->nim)
            ->where('tahun_academic_id', $request->tahun_academic_id)
            ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
            ->select('krs.id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
            ->get();
    
        $data_khs = [
            'mhs_data' => $nilai_akhirs,
            'nim' => $request->nim,
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

    
    
        return view('dashboard.master.khs.show', compact('data_khs', 'tahun_academic'));
    }
    
}
