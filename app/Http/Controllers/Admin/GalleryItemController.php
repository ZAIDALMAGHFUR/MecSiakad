<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryItemController extends Controller
{
    public function index(Request $request)
    {
        $galleryItems = GalleryItem::query()
            ->with('gallery')
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.master.gallery-items.index', compact('galleryItems'));
    }

    public function add()
    {
        $galleries = Gallery::orderBy('title', 'asc')->get();
        return view('dashboard.master.gallery-items.add', compact('galleries'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'gallery_id' => 'required|numeric',
            'thumbnail' => 'required|image|max:5000'
        ], [
            'gallery_id.required'   => 'Silahkan isi Parent Galeri terlebih dahulu!',
            'thumbnail.required' => 'Silahkan pilih thumbnail terlebih dahulu!',
        ]);

        //create post
        GalleryItem::create(array_merge(
            [
                'gallery_id'     => $validatedData['gallery_id'],
            ],
            $request->hasFile('thumbnail') ?
                ['thumbnail' => $request->file('thumbnail')->store('thumbnails', ['disk' => 'public'])] : []
        ));

        return redirect()->route('gallery-items.index')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }



    public function edit($id)
    {
        $galleries = Gallery::orderBy('title', 'asc')->get();
        $data = GalleryItem::findOrFail($id);
        return view('dashboard.master.gallery-items.edit', compact('data', 'galleries'));
    }

    public function update(Request $request, $id)
    {
        $galleryItem = GalleryItem::findOrFail($id);

        $validatedData = $this->validate($request, [
            'gallery_id' => 'required|numeric',
            'thumbnail' => 'sometimes|image|max:5000|nullable'
        ], [
            'gallery_id.required'   => 'Silahkan isi Parent Galeri terlebih dahulu!',
            'thumbnail.required' => 'Silahkan pilih thumbnail terlebih dahulu!',
        ]);

        $galleryItem->update([
            'gallery_id'     => $validatedData['gallery_id'],
            'thumbnail' => $this->uploadOrReturnDefault('thumbnail', $galleryItem->thumbnail, 'thumbnails'),
        ]);

        return redirect()->route('gallery-items.index')->with([
            'success' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);
    }


    public function destroy($id)
    {
        $galleryItem = GalleryItem::findOrFail($id);

        Storage::disk('public')->delete($galleryItem->thumbnail);
        $galleryItem->delete();

        return redirect()->route('gallery-items.index')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
