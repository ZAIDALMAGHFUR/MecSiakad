<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use App\Models\jadwal_pmbs;
use App\Models\Jurnal;
use App\Models\Page;
use App\Models\StrJabatan;
use App\Models\StrukturKepemimpinan;
use App\Models\Program_studies;
use App\Models\Mata_Kuliah;
use App\Models\Downloads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class LandingPageController extends Controller
{
    public function __construct()
    {
        $pages = Page::all();
        $pages = $pages->groupBy('group_menu');
        View::share('pages', $pages);
    }

    private function checkIfShowModal()
    {
        $exist = Cookie::has('show_modal');

        if ($exist) {
            return Cookie::get('show_modal');
        } else {
            Cookie::queue(Cookie::make('show_modal', true, 60 * 24 * 1)); // 1 hari
        }

        return true;
    }

    public function hideModal(Request $request)
    {
        Cookie::queue(Cookie::make('show_modal', false, 60 * 24 * 1));
        return back();
    }

    public function index()
    {
        $newestBerita = Berita::orderBy('created_at', 'desc')->take(6)->get();
        $newestJurnal = Jurnal::orderBy('created_at', 'desc')->take(6)->get();
        $newestGaleri = Gallery::orderBy('created_at', 'desc')->take(6)->get();
        $today = today();

        $jadwalPmb = jadwal_pmbs::whereDate('tgl_mulai', '<=', $today)->whereDate('tgl_akhir', '>=', $today)->first();
        $showModal = $this->checkIfShowModal();

        return view('landing-pages.index', [
            'newestBerita' => $newestBerita,
            'newestJurnal' => $newestJurnal,
            'newestGaleri' => $newestGaleri,
            'jadwalPmb' => $jadwalPmb,
            'showModal' => $showModal
        ]);
    }

    public function berita()
    {
        $keyword = request('keyword');
        $tag = request('tag');
        $category = request('category');

        $berita = Berita::orderBy('created_at', 'desc')
            ->when(
                $keyword,
                fn ($query) => $query
                    ->where('title', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
                    ->orWhere('category', 'LIKE', "%$keyword%")
            )
            ->when(
                $tag,
                fn ($query) => $query
                    ->whereJsonContains('tags', $tag)
            )
            ->when(
                $category,
                fn ($query) => $query
                    ->where('category', $category)
            )
            ->paginate()
            ->withQueryString();

        return view('landing-pages.berita.index', [
            'berita' => $berita
        ]);
    }

    public function beritaDetail(Berita $berita)
    {
        $lastBerita = Berita::orderBy('created_at', 'desc')->take(3)->get();
        $sameByCategoryBerita = Berita::where('category', $berita->category)->orderBy('created_at', 'desc')->take(3)->get();

        return view('landing-pages.berita.detail', [
            'berita' => $berita,
            'lastBerita' => $lastBerita,
            'sameByCategoryBerita' => $sameByCategoryBerita
        ]);
    }


    public function jurnal()
    {
        $keyword = request('keyword');
        $tag = request('tag');
        $category = request('category');

        $jurnal = Jurnal::orderBy('created_at', 'desc')
            ->when(
                $keyword,
                fn ($query) => $query
                    ->where('title', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
                    ->orWhere('category', 'LIKE', "%$keyword%")
            )
            ->when(
                $tag,
                fn ($query) => $query
                    ->whereJsonContains('tags', $tag)
            )
            ->when(
                $category,
                fn ($query) => $query
                    ->where('category', $category)
            )
            ->paginate()
            ->withQueryString();

        return view('landing-pages.jurnal.index', [
            'jurnal' => $jurnal
        ]);
    }

    public function jurnalDetail(Jurnal $jurnal)
    {
        $lastJurnal = Jurnal::orderBy('created_at', 'desc')->take(3)->get();
        $sameByCategoryJurnal = Jurnal::where('category', $jurnal->category)->orderBy('created_at', 'desc')->take(3)->get();

        return view('landing-pages.jurnal.detail', [
            'jurnal' => $jurnal,
            'lastJurnal' => $lastJurnal,
            'sameByCategoryJurnal' => $sameByCategoryJurnal
        ]);
    }

    public function pageDetail(Page $page)
    {
        return view('landing-pages.pages.detail', [
            'page' => $page
        ]);
    }

    public function galleries()
    {
        $keyword = request('keyword');

        $galleries = Berita::orderBy('created_at', 'desc')
            ->when(
                $keyword,
                fn ($query) => $query
                    ->where('title', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
            )
            ->paginate()
            ->withQueryString();

        return view('landing-pages.galleries.index', [
            'galleries' => $galleries
        ]);
    }

    public function strukturKps()
    {
        $structures = [];
        $hierarchies = StrJabatan::max('hierarki');

        for ($i=0; $i < $hierarchies; $i++) {
            $structures[$i] = StrJabatan::with('strukturKepemimpinan')->where('hierarki', $i+1)->get()->toArray();
        }

        // dd($structures);

        return view('landing-pages.struktur-kps.index', compact('structures', 'hierarchies'));
    }

    public function galleryDetail(Gallery $gallery)
    {
        $gallery->load('galleryItems');

        return view('landing-pages.galleries.detail', [
            'gallery' => $gallery,
        ]);
    }


    public function sejarah()
    {
        return view('landing-pages.sejarah.index');
    }

    public function visiMisi()
    {
        return view('landing-pages.visi-misi.index');
    }

    public function prodi()
    {

        $Mata_Kuliah = Mata_Kuliah::where('program_studies_id', 1)->get();
        // dd($Mata_Kuliah);

        return view('landing-pages.prodi.index', [
            'Mata_Kuliah' => $Mata_Kuliah
        ]);
    }

    public function prodiindustri()
    {
        $Mata_Kuliah_industri = Mata_Kuliah::where('program_studies_id', 2)->get();

        return view('landing-pages.prodi.industri', [
            'Mata_Kuliah_industri' => $Mata_Kuliah_industri
        ]);
    }


    public function download(){
        $Downloads = Downloads::where('to', 'umum')->get();
        // dd($Downloads);
        return view('landing-pages.download.index', [
            'Downloads' => $Downloads
        ]);
    }

    public function downloadrill($id)
    {
        $data = Downloads::find($id);

        if (!$data) {
            return redirect()->back()->with([
                'danger' => 'File tidak ditemukan',
                'alert-type' => 'danger'
            ]);
        }

        return response()->download(public_path(). Storage::url($data->file_path), $data->file_name);
    }
}
