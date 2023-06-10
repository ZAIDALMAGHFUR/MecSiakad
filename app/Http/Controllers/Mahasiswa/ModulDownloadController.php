<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Downloads;

class ModulDownloadController extends Controller
{
    public function index()
    {
        $download = Downloads::all();
        return view('dashboard.mahasiswa.Download-mhs.index', compact('download'));
    }

    public function download($id)
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
