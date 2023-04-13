<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Mata_Kuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DosenMataKuliahDosenController extends Controller
{
    public function index()
    {
        $dosen_id = Auth::user()->id;
        $Mata_Kuliah = Mata_Kuliah::where('dosen_id', $dosen_id)->get();
        dd($Mata_Kuliah);
        return view('dashboard.dosen.data-matkul.index', compact('Mata_Kuliah'));
    }
    
}
