<?php

namespace App\Http\Controllers;

use App\Models\fotos;
use App\Models\Persyaratans;
use Illuminate\Http\Request;

class calonController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $Persyaratans = Persyaratans::all();
        $fotos = fotos::all();
        return view('dashboard.PMB.calon', compact('Persyaratans', 'fotos'));
    }
}
