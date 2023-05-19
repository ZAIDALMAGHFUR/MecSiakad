<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\Mata_Kuliah;
use App\Models\Program_studies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JurnalController extends Controller
{
    public function index(Request $request)
    {
        $jurnal = Jurnal::query()
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.master.jurnal.index', compact('jurnal'));
    }

    public function add()
    {
        return view('dashboard.master.jurnal.add');
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
        'title.required'   => 'Silahkan isi Judul Jurnal terlebih dahulu!',
        'category.required' => 'Silahkan isi Category terlebih dahulu!',
        'tags.required' => "Silahkan isi Tags (jika lebih dari satu pisahkan dengan ',') terlebih dahulu!",
        'description.required' => 'Silahkan isi Description terlebih dahulu!',
        'body.required' => 'Silahkan isi Body Konten terlebih dahulu!',
        'thumbnail.required' => 'Silahkan pilih thumbnail terlebih dahulu!',
        'tanggal_publish.required' => 'Silahkan isi Tanggal Publish terlebih dahulu!',
    ]);

    //create post
    Jurnal::create(array_merge(
        [
            'title'     => $validatedData['title'],
            'category'     => $validatedData['category'],
            'tags'     => array_map(fn ($tag) => trim($tag), explode(',', $validatedData['tags'])),
            'description' => $validatedData['description'],
            'body' => $validatedData['body'],
            'tanggal_publish' => $validatedData['tanggal_publish'],
        ],
        $request->hasFile('thumbnail') ?
            ['thumbnail' => $request->file('thumbnail')->store('thumbnails', 'public')] : []
    ));

    return redirect()->route('jurnal.index')->with([
        'success' => 'Data berhasil ditambahkan',
        'alert-type' => 'success'
    ]);
}




    public function edit($id)
    {
        $data = Jurnal::findOrFail($id);
        return view('dashboard.master.jurnal.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $jurnal = Jurnal::findOrFail($id);

        $validatedData = $this->validate($request, [
            'title' => 'required',
            'category'    => 'required',
            'tags'    => 'required',
            'description'    => 'required|max:1000',
            'body'    => 'required',
            'thumbnail' => 'sometimes|image|max:5000|nullable',
            'tanggal_publish' => 'required'
        ], [
            'title.required'   => 'Silahkan isi Judul Jurnal terlebih dahulu!',
            'category.required' => 'Silahkan isi Category terlebih dahulu!',
            'tags.required' => "Silahkan isi Tags (jika lebih dari satu pisahkan dengan ',') terlebih dahulu!",
            'description.required' => 'Silahkan isi Description terlebih dahulu!',
            'body.required' => 'Silahkan isi Body Konten terlebih dahulu!',
            'thumbnail.required' => 'Silahkan pilih thumbnail terlebih dahulu!',
            'tanggal_publish.required' => 'Silahkan isi Tanggal Publish terlebih dahulu!',
        ]);

        $jurnal->update([
            'title'     => $validatedData['title'],
            'thumbnail' => $this->uploadOrReturnDefault('thumbnail', $jurnal->thumbnail, 'thumbnails'),
            'category'     => $validatedData['category'],
            'tags'     => array_map(fn ($tag) => trim($tag), explode(',', $validatedData['tags'])),
            'description' => $validatedData['description'],
            'body' => $validatedData['body'],
            'tanggal_publish' => $validatedData['tanggal_publish'],
        ]);

        return redirect()->route('jurnal.index')->with([
            'success' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);
    }


    public function destroy($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        Storage::disk('public')->delete($jurnal->thumbnail);
        $jurnal->delete();

        return redirect()->route('jurnal.index')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
