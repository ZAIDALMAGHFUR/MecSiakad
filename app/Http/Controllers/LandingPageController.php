<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use App\Models\jadwal_pmbs;
use App\Models\Jurnal;
use App\Models\Page;
use App\Models\StrJabatan;
use App\Models\StrukturKepemimpinan;
use Illuminate\Http\Request;
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

        $jurnal = Berita::orderBy('created_at', 'desc')
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
        $strukturKps = StrukturKepemimpinan::orderBy('name', 'asc')->get();
        $jabatans = StrJabatan::orderBy('order', 'asc')->get();

        return view('landing-pages.struktur-kps.index', compact('strukturKps', 'jabatans'));
    }

    public function galleryDetail(Gallery $gallery)
    {
        $gallery->load('galleryItems');

        return view('landing-pages.galleries.detail', [
            'gallery' => $gallery,
        ]);
    }
}
