<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        return view('dashboard.dosen.input-nilai.index');
    }
}
