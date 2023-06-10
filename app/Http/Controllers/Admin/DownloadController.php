<?php

namespace App\Http\Controllers\Admin;
use App\Models\Downloads;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index()
    {
        $download = Downloads::all();
        return view('dashboard.master.Download.index', compact('download'));
    }

    public function add()
    {
        return view('dashboard.master.Download.add');
    }

    public function store(Request $request){
    // dd($request->all());
    $request->validate([
        'name' => 'required',
        'file_path' => 'required|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar',
        'to' => 'required',
    ]);

    $file = $request->file('file_path');
    $file_path = $file->store('file_download', 'public');
    $original_name = $file->getClientOriginalName();
    
    $data = [
        'name' => $request->name,
        'file_path' => $file_path,
        'to' => $request->to,
        'file_name' => $original_name,
    ];

    Downloads::create($data);

    return redirect()->route('download')->with([
        'success' => 'Data berhasil ditambahkan',
        'alert-type' => 'success'
    ]);
    }

    public function edit($id){
        $data = Downloads::findOrFail($id);
        return view('dashboard.master.Download.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'file_path' => 'required|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar',
            'to' => 'required',
        ]);
    
        $data = Downloads::findOrFail($id);
    
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            File::delete(public_path() . storage_path($data->file_path));
            $file_path = $file->store('file_download', 'public');
            $original_name = $file->getClientOriginalName();
            $data->file_path = $file_path;
            $data->file_name = $original_name;
        }
    
        $data->name = $request->name;
        $data->to = $request->to;
        $data->save();
    
        return redirect()->route('download')->with([
            'success' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);
    }
    

    public function delete($id)
    {
        $data = Downloads::findOrFail($id);
        $data->delete();

        return redirect()->route('download')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
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
