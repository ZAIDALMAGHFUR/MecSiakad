<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class MahasiswaController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('card-stats-' . auth()->id(), 60 * 1, fn () => $this->_getStats());

        return view('dashboard.mahasiswa', [
            'stats' => $stats
        ]);
    }

    private function _getStats()
    {
        $ipk = $this->_calculateIPK(); // Memanggil fungsi perhitungan IPK
        $sks = $this->_calculateSKS(); // Memanggil fungsi perhitungan SKS
        $Semester = $this->_calculateSemester(); // Memanggil fungsi perhitungan Semester
        return [
            [
                "label" => "IPK",
                "value" => $ipk,
                'icon' => 'users'
            ],
            [
                'label' => 'Jumlah SKS',
                'value' => $sks,
                'icon' => 'check-circle'
            ],
            [
                'label' => 'Semester',
                'value' => $Semester,
                'icon' => 'clipboard'
            ]
        ];
    }

    private function _calculateIPK()
    {

    {
        $mhsinfo = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $nim = $mhsinfo->nim;
        $data = (object)[];
        $data->mhs = Mahasiswa::where('nim', $nim)->first();
        $data->tahun_academic = TahunAcademic::all()->first();
        $data->tahun_akademik_id = $data->tahun_academic->id;
        $data->program_studies_id = $data->mhs->program_studies_id;

        $select_krs = Krs::where('nim', $nim)
            // ->where('tahun_academic_id', $data->tahun_akademik_id)
            ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
            ->select('krs.id', 'krs.mata_kuliah_id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
            ->get();
            // dd($select_krs);


        $matkul = $select_krs->pluck('mata_kuliah_id');

        $nilai_akhirs = Nilai::select('mahasiswas_id', 'mata_kuliahs_id', 'nilai_akhir')
            ->where('mahasiswas_id', $mhsinfo->id)
            // ->where('tahun_academic_id', $data->tahun_academic->id)
            ->get();


        if($nilai_akhirs->isEmpty()){
            return 0;
        }     //fix zaid

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
            if ($nilai_akhir->kriteria == 'A') {
                $nilai_akhir->bobot = 4;
            } elseif ($nilai_akhir->kriteria == 'B') {
                $nilai_akhir->bobot = 3;
            } elseif ($nilai_akhir->kriteria == 'C') {
                $nilai_akhir->bobot = 2;
            } elseif ($nilai_akhir->kriteria == 'D') {
                $nilai_akhir->bobot = 1;
            } elseif ($nilai_akhir->kriteria == 'E') {
                $nilai_akhir->bobot = 0;
            }
        }

        $total_sks = 0;
        foreach ($select_krs as $sks) {
            $total_sks += $sks->sks;
        }

        $total_nilai = 0;
        // dd($nilai_akhirs->toArray());
        foreach ($select_krs as $index => $khs) {
            $bobot = $nilai_akhirs[$index]->bobot ?? 0;
            $nilai = $khs->sks * $bobot;
            $total_nilai += $nilai;
        }

        if ($total_sks == 0) {
            $ipk = 0;
        } else {
            $ipk = number_format($total_nilai / $total_sks, 2);
        }
        // dd($ipk);
        return $ipk;
    };
}

    private function _calculateSKS()
    {
        {
            $mhsinfo = Mahasiswa::where('user_id', Auth::user()->id)->first();
            $nim = $mhsinfo->nim;
            $data = (object)[];
            $data->mhs = Mahasiswa::where('nim', $nim)->first();
            $data->tahun_academic = TahunAcademic::all()->first();
            $data->tahun_akademik_id = $data->tahun_academic->id;
            $data->program_studies_id = $data->mhs->program_studies_id;

            $select_krs = Krs::where('nim', $nim)
                // ->where('tahun_academic_id', $data->tahun_akademik_id)
                ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
                ->select('krs.id', 'krs.mata_kuliah_id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
                ->get();

            $matkul = $select_krs->pluck('sks');
            $matkulTotal = collect($matkul)->sum();
            // dd($matkulTotal);
            // dd($matkul);
            return $matkulTotal;
        }
    }

    private function _calculateSemester()
    {
    {
        $mhsinfo = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $nim = $mhsinfo->nim;
        $data = (object)[];
        $data->mhs = Mahasiswa::where('nim', $nim)->first();
        $data->tahun_academic = TahunAcademic::all()->first();
        $data->tahun_akademik_id = $data->tahun_academic->id;
        $data->program_studies_id = $data->mhs->program_studies_id;

        $select_krs = Krs::where('nim', $nim)
            // ->where('tahun_academic_id', $data->tahun_akademik_id)
            ->join('mata_kuliahs', 'krs.mata_kuliah_id', '=', 'mata_kuliahs.id')
            ->select('krs.id', 'krs.mata_kuliah_id', 'mata_kuliahs.name_mata_kuliah', 'mata_kuliahs.kode_mata_kuliah', 'mata_kuliahs.sks')
            ->get();

        $matkul = $select_krs->pluck('sks');
        $matkulTotal = collect($matkul)->sum();
        $smt = $matkulTotal / 24;
        $smt = ceil($smt);
        return $smt;
    }
}

    public function profile(){
        $profile = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $user = User::where('id', Auth::user()->id)->first();
        // dd($profile);
        // dd($user);
        return view('dashboard.mahasiswa.profile.index', compact('profile', 'user'));
    }
}
