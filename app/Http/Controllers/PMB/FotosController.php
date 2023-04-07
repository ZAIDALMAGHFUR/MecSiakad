<?php

namespace App\Http\Controllers\PMB;

use App\Models\fotos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FotosController extends Controller
{
    public function index()
    {
        $fotos = fotos::all();
        return view('dashboard.master.fotobrosur.index', compact('fotos'));
    }

    public function add()
    {
        return view('dashboard.master.fotobrosur.add');
    }

    public function store(Request $request){
        $this->validate($request, [
            'foto_kampus' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus4' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus5' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus6' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus7' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus8' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus9' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus10' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'foto_kampus.required' => 'tidak boleh kosong!',
            'foto_kampus2.required' => 'tidak boleh kosong!',
            'foto_kampus3.required' => 'tidak boleh kosong!',
            'foto_kampus4.required' => 'tidak boleh kosong!',
            'foto_kampus5.required' => 'tidak boleh kosong!',
            'foto_kampus6.required' => 'tidak boleh kosong!',
            'foto_kampus7.required' => 'tidak boleh kosong!',
            'foto_kampus8.required' => 'tidak boleh kosong!',
            'foto_kampus9.required' => 'tidak boleh kosong!',
            'foto_kampus10.required' => 'tidak boleh kosong!',
        ]);

        $fotos = fotos::create([
            'foto_kampus' => $request->file('foto_kampus')->store('public/foto_kampus'),
            'foto_kampus2' =>  $request->file('foto_kampus2')->store('public/foto_kampus'),
            'foto_kampus3' =>  $request->file('foto_kampus3')->store('public/foto_kampus'),
            'foto_kampus4' =>  $request->file('foto_kampus4')->store('public/foto_kampus'),
            'foto_kampus5' =>  $request->file('foto_kampus5')->store('public/foto_kampus'),
            'foto_kampus6' =>  $request->file('foto_kampus6')->store('public/foto_kampus'),
            'foto_kampus7' =>  $request->file('foto_kampus7')->store('public/foto_kampus'),
            'foto_kampus8' =>  $request->file('foto_kampus8')->store('public/foto_kampus'),
            'foto_kampus9' =>  $request->file('foto_kampus9')->store('public/foto_kampus'),
            'foto_kampus10' =>  $request->file('foto_kampus10')->store('public/foto_kampus'),
        ]);

        $fotos->save();
        
        return redirect()->route('foto')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id){

        $fotos = fotos::findOrFail($id);
        return view('dashboard.master.fotobrosur.edit', compact('fotos'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'foto_kampus' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus5' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus6' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus7' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus8' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus9' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_kampus10' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'foto_kampus' => 'Harus berupa Gambar !',
            'foto_kampus2' => 'Harus berupa Gambar !',
            'foto_kampus3' => 'Harus berupa Gambar !',
            'foto_kampus4' => 'Harus berupa Gambar !',
            'foto_kampus5' => 'Harus berupa Gambar !',
            'foto_kampus6' => 'Harus berupa Gambar !',
            'foto_kampus7' => 'Harus berupa Gambar !',
            'foto_kampus8' => 'Harus berupa Gambar !',
            'foto_kampus9' => 'Harus berupa Gambar !',
            'foto_kampus10' => 'Harus berupa Gambar !',
        ]);

        $fotos = fotos::findOrFail($id);

        $fotos->update([
            'foto_kampus' => $request->file('foto_kampus')->store('public/foto_kampus'),
            'foto_kampus2' =>  $request->file('foto_kampus2')->store('public/foto_kampus'),
            'foto_kampus3' =>  $request->file('foto_kampus3')->store('public/foto_kampus'),
            'foto_kampus4' =>  $request->file('foto_kampus4')->store('public/foto_kampus'),
            'foto_kampus5' =>  $request->file('foto_kampus5')->store('public/foto_kampus'),
            'foto_kampus6' =>  $request->file('foto_kampus6')->store('public/foto_kampus'),
            'foto_kampus7' =>  $request->file('foto_kampus7')->store('public/foto_kampus'),
            'foto_kampus8' =>  $request->file('foto_kampus8')->store('public/foto_kampus'),
            'foto_kampus9' =>  $request->file('foto_kampus9')->store('public/foto_kampus'),
            'foto_kampus10' =>  $request->file('foto_kampus10')->store('public/foto_kampus'),
        ]);
        return redirect()->route('foto')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }



    public function destroy($id)
    {
        $data = fotos::findOrFail($id);
        Storage::delete([
            $data->foto_kampus,
            $data->foto_kampus2,
            $data->foto_kampus3,
            $data->foto_kampus4,
            $data->foto_kampus5,
            $data->foto_kampus6,
            $data->foto_kampus7,
            $data->foto_kampus8,
            $data->foto_kampus9,
            $data->foto_kampus10,
        ]);
        $data->delete();

        return redirect()->back()->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }   
    
}
