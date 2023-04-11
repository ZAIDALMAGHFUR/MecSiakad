<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditNilaiController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        $nilai = Nilai::all();
        return view('dashboard.master.edit-nilai.index', compact('mahasiswa', 'nilai'));
    }
}
