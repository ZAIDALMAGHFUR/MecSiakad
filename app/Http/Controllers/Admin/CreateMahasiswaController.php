<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Program_studies;
use Illuminate\Http\Request;

class CreateMahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::all();
        return view('dashboard.master.mahasiswa.index', compact('data'));
    }

    public function create()
    {
        $program_studies = Program_studies::all();
        return view('dashboard.master.mahasiswa.create', compact('program_studies'));
    }
}
