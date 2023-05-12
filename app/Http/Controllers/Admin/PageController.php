<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Mata_Kuliah;
use App\Models\Program_studies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::query()
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.master.page.index', compact('page'));
    }

    public function add()
    {
        return view('dashboard.master.page.add');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'title' => 'required',
            'menu' => 'required',
            'group_menu' => '',
            'description'    => 'required|max:1000',
            'body'    => 'required',
            'thumbnail' => 'sometimes|image|max:5000|nullable'
        ], [
            'title.required'   => 'Silahkan isi Judul Page terlebih dahulu!',
            'category.required' => 'Silahkan isi Category terlebih dahulu!',
            'tags.required' => "Silahkan isi Tags (jika lebih dari satu pisahkan dengan ',') terlebih dahulu!",
            'description.required' => 'Silahkan isi Description terlebih dahulu!',
            'body.required' => 'Silahkan isi Body Konten terlebih dahulu!',
        ]);

        //create post
        Page::create(array_merge(
            [
                'title'     => $validatedData['title'],
                'group_menu'     => $validatedData['group_menu'],
                'menu'     => $validatedData['menu'],
                'description' => $validatedData['description'],
                'body' => $validatedData['body'],
            ],
            $request->hasFile('thumbnail') ?
                ['thumbnail' => $request->file('thumbnail')->store('thumbnails', ['disk' => 'public'])] : []
        ));

        return redirect()->route('page.index')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }



    public function edit($id)
    {
        $data = Page::findOrFail($id);
        return view('dashboard.master.page.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $validatedData = $this->validate($request, [
            'title' => 'required',
            'group_menu' => 'required',
            'menu' => 'required',
            'description'    => 'required|max:1000',
            'body'    => 'required',
            'thumbnail' => 'sometimes|image|max:5000|nullable'
        ], [
            'title.required'   => 'Silahkan isi Judul Page terlebih dahulu!',
            'category.required' => 'Silahkan isi Category terlebih dahulu!',
            'tags.required' => "Silahkan isi Tags (jika lebih dari satu pisahkan dengan ',') terlebih dahulu!",
            'description.required' => 'Silahkan isi Description terlebih dahulu!',
            'body.required' => 'Silahkan isi Body Konten terlebih dahulu!',
        ]);

        $page->update([
            'title'     => $validatedData['title'],
            'group_menu'     => $validatedData['group_menu'],
            'menu'     => $validatedData['menu'],
            'thumbnail' => $this->uploadOrReturnDefault('thumbnail', $page->thumbnail, 'thumbnails'),
            'description' => $validatedData['description'],
            'body' => $validatedData['body'],
        ]);

        return redirect()->route('page.index')->with([
            'success' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);
    }


    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        $page->thumbnail && Storage::disk('public')->delete($page->thumbnail);

        $page->delete();

        return redirect()->route('page.index')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
