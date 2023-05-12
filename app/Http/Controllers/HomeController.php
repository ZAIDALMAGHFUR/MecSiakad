<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Dosen;
use App\Models\DosenJabatan;
use App\Models\Gallery;
use App\Models\Jurnal;
use App\Models\Mahasiswa;
use App\Models\Mata_Kuliah;
use App\Models\Page;
use App\Models\Program_studies;
use App\Models\TahunAcademic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stats = Cache::remember('card-stats-' . auth()->id(), 60 * 1, fn () => $this->_getStats());

        return view('dashboard.home', [
            'stats' => $stats
        ]);
    }

    private function _getStats()
    {
        return [
            [
                "label" => "Berita Hari ini",
                "value" => Berita::whereDate('created_at', today())->count(),
                'icon' => 'sun'
            ],
            [
                "label" => "Berita",
                "value" => Berita::count(),
                'icon' => 'info'
            ],
            [
                "label" => "Jurnal Hari ini",
                "value" => Jurnal::whereDate('created_at', today())->count(),
                'icon' => 'sun'
            ],
            [
                "label" => "Jurnal",
                "value" => Jurnal::count(),
                'icon' => 'clipboard'
            ],
            [
                "label" => "Galeri Hari ini",
                "value" => Gallery::whereDate('created_at', today())->count(),
                'icon' => 'sun'
            ],
            [
                "label" => "Galeri",
                "value" => Gallery::count(),
                'icon' => 'grid'
            ],
            [
                "label" => "Halaman",
                "value" => Page::count(),
                'icon' => 'layout'
            ],
            [
                "label" => "Program Studi",
                "value" => Program_studies::count(),
                'icon' => 'tag'
            ],
            [
                "label" => "Tahun Akedemik",
                "value" => TahunAcademic::count(),
                'icon' => 'calendar'
            ],
            [
                "label" => "Mata Kuliah",
                "value" => Mata_Kuliah::count(),
                'icon' => 'book'
            ],
            [
                "label" => "Mahasiswa",
                "value" => Mahasiswa::count(),
                'icon' => 'users'
            ],
            [
                "label" => "Mahasiswa (Aktif)",
                "value" => Mahasiswa::where('status', 'aktif')->count(),
                'icon' => 'check-circle'
            ],
            [
                "label" => "Mahasiswa (Tidak Aktif)",
                "value" => Mahasiswa::where('status', 'tidak aktif')->count(),
                'icon' => 'x'
            ],
            [
                "label" => "Mahasiswa (Lulus)",
                "value" => Mahasiswa::where('status', 'lulus')->count(),
                'icon' => 'check'
            ],
            [
                "label" => "Mahasiswa (Drop Out)",
                "value" => Mahasiswa::where('status', 'drop out')->count(),
                'icon' => 'log-out'
            ],
            [
                "label" => "Mahasiswa (Alumni)",
                "value" => Mahasiswa::where('status', 'alumni')->count(),
                'icon' => 'archive'
            ],
            [
                "label" => "Dosen",
                "value" => Dosen::count(),
                'icon' => 'edit-3'
            ],
            [
                "label" => "Dosen (Aktif)",
                "value" => Dosen::where('status', 'aktif')->count(),
                'icon' => 'check-circle'
            ],
            [
                "label" => "Dosen (Tidak Aktif)",
                "value" => Dosen::where('status', 'tidak aktif')->count(),
                'icon' => 'x'
            ],
            [
                "label" => "Dosen (Pensiun)",
                "value" => Dosen::where('status', 'pensiun')->count(),
                'icon' => 'archive'
            ],
            [
                "label" => "Dosen (Keluar)",
                "value" => Dosen::where('status', 'keluar')->count(),
                'icon' => 'log-out'
            ],
        ];
    }
}
