<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenMatkul;
use App\Models\DosenJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DosenController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('card-stats-' . auth()->id(), 30 * 1, fn () => $this->_getStats());

        return view('dashboard.dosen', [
            'stats' => $stats
        ] );
    }

    private function _getStats()
    {
        $matkul = $this->_calculateMatkul(); // Memanggil fungsi perhitungan IPK
        $jabtan = $this->_jabatan(); // Memanggil fungsi jabatan

        return [
            [
                "label" => "Jumlah Matkul",
                "value" => $matkul,
                'icon' => 'users'
            ],
            [
                'label' => 'Jabatan',
                'value' => $jabtan,
                'icon' => 'check-circle'
            ]
        ];
    }

    private function _calculateMatkul()
    {
        $auth = Auth::user()->id;
        $dosen = Dosen::where('users_id', $auth)->first();
        $dosenMatkul = DosenMatkul::where('dosen_id', $dosen->id)->get();
        $matkul = count($dosenMatkul);
        // dd($matkul);

        return $matkul;
    }

    private function _jabatan()
    {
        $auth = Auth::user()->id;
        $dosen = Dosen::where('users_id', $auth)->first();
        $dosenJabatan = DosenJabatan::where('dosen_id', $dosen->id)->first();
        $jabatan = $dosenJabatan->jabatan->nama_jabatan;
        // dd($jabatan);
        return $jabatan;
    }

}
