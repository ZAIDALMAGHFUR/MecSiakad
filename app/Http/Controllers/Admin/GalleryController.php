<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $galeri = Gallery::query()
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.master.galeri.index', compact('galeri'));
    }

    public function add()
    {
        return view('dashboard.master.galeri.add');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'title' => 'required',
            'description'    => 'required|max:1000',
            'thumbnail' => 'required|image|max:5000'
        ], [
            'title.required'   => 'Silahkan isi Judul Gallery terlebih dahulu!',
            'description.required' => 'Silahkan isi Description terlebih dahulu!',
            'thumbnail.required' => 'Silahkan pilih thumbnail terlebih dahulu!',
        ]);

        //create post
        Gallery::create(array_merge(
            [
                'title'     => $validatedData['title'],
                'description' => $validatedData['description'],
            ],
            $request->hasFile('thumbnail') ?
                ['thumbnail' => $request->file('thumbnail')->store('thumbnails', ['disk' => 'public'])] : []
        ));

        return redirect()->route('galeri.index')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }



    public function edit($id)
    {
        $data = Gallery::findOrFail($id);
        return view('dashboard.master.galeri.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Gallery::findOrFail($id);

        $validatedData = $this->validate($request, [
            'title' => 'required',
            'description'    => 'required|max:1000',
            'thumbnail' => 'sometimes|image|max:5000|nullable'
        ], [
            'title.required'   => 'Silahkan isi Judul Gallery terlebih dahulu!',
            'description.required' => 'Silahkan isi Description terlebih dahulu!',
            'thumbnail.required' => 'Silahkan pilih thumbnail terlebih dahulu!',
        ]);

        $galeri->update([
            'title'     => $validatedData['title'],
            'thumbnail' => $this->uploadOrReturnDefault('thumbnail', $galeri->thumbnail, 'thumbnails'),
            'description' => $validatedData['description'],
        ]);

        return redirect()->route('galeri.index')->with([
            'success' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);
    }


    public function destroy($id)
    {
        $galeri = Gallery::findOrFail($id);

        Storage::disk('public')->delete($galeri->thumbnail);
        $galeri->delete();

        return redirect()->route('galeri.index')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
