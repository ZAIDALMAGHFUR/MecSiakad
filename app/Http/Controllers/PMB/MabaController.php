<?php

namespace App\Http\Controllers\PMB;

use App\Models\Pengumuman;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class MabaController extends Controller
{
    public function index()
    {
        $Pengumuman = Pengumuman::all();
        // dd($Pengumuman->toArray());
        return view('dashboard.master.maba.maba', compact('Pengumuman'));
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'Maba.xlsx');
    }
}
