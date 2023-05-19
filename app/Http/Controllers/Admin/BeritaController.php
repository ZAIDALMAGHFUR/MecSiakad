<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Mata_Kuliah;
use App\Models\Program_studies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $berita = Berita::query()
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.master.berita.index', compact('berita'));
    }

    public function add()
    {
        return view('dashboard.master.berita.add');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'title' => 'required',
            'category'    => 'required',
            'tags'    => 'required',
            'description'    => 'required|max:1000',
            'body'    => 'required',
            'thumbnail' => 'required|image|max:5000',
            'tanggal_publish' => 'required'
        ], [
            'title.required'   => 'Silahkan isi Judul Berita terlebih dahulu!',
            'category.required' => 'Silahkan isi Category terlebih dahulu!',
            'tags.required' => "Silahkan isi Tags (jika lebih dari satu pisahkan dengan ',') terlebih dahulu!",
            'description.required' => 'Silahkan isi Description terlebih dahulu!',
            'body.required' => 'Silahkan isi Body Konten terlebih dahulu!',
            'thumbnail.required' => 'Silahkan pilih thumbnail terlebih dahulu!',
            'tanggal_publish.required' => 'Silahkan isi Tanggal Publish terlebih dahulu!',
        ]);

        //create post
        Berita::create(array_merge(
            [
                'title'     => $validatedData['title'],
                'category'     => $validatedData['category'],
                'tags'     => array_map(fn ($tag) => trim($tag), explode(',', $validatedData['tags'])),
                'description' => $validatedData['description'],
                'body' => $validatedData['body'],
                'tanggal_publish' => $validatedData['tanggal_publish'],
            ],
            $request->hasFile('thumbnail') ?
                ['thumbnail' => $request->file('thumbnail')->store('thumbnails', ['disk' => 'public'])] : []
        ));

        return redirect()->route('berita.index')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }



    public function edit($id)
    {
        $data = Berita::findOrFail($id);
        return view('dashboard.master.berita.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validatedData = $this->validate($request, [
            'title' => 'required',
            'category'    => 'required',
            'tags'    => 'required',
            'description'    => 'required|max:1000',
            'body'    => 'required',
            'thumbnail' => 'sometimes|image|max:5000|nullable',
            'tanggal_publish' => 'required'
        ], [
            'title.required'   => 'Silahkan isi Judul Berita terlebih dahulu!',
            'category.required' => 'Silahkan isi Category terlebih dahulu!',
            'tags.required' => "Silahkan isi Tags (jika lebih dari satu pisahkan dengan ',') terlebih dahulu!",
            'description.required' => 'Silahkan isi Description terlebih dahulu!',
            'body.required' => 'Silahkan isi Body Konten terlebih dahulu!',
            'thumbnail.required' => 'Silahkan pilih thumbnail terlebih dahulu!',
            'tanggal_publish.required' => 'Silahkan isi Tanggal Publish terlebih dahulu!',
        ]);

        $berita->update([
            'title'     => $validatedData['title'],
            'thumbnail' => $this->uploadOrReturnDefault('thumbnail', $berita->thumbnail, 'thumbnails'),
            'category'     => $validatedData['category'],
            'tags'     => array_map(fn ($tag) => trim($tag), explode(',', $validatedData['tags'])),
            'description' => $validatedData['description'],
            'body' => $validatedData['body'],
            'tanggal_publish' => $validatedData['tanggal_publish'],
        ]);

        return redirect()->route('berita.index')->with([
            'success' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);
    }


    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        Storage::disk('public')->delete($berita->thumbnail);
        $berita->delete();

        return redirect()->route('berita.index')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
