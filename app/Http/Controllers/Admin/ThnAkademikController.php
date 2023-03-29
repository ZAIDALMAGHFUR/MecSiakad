<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Http\Controllers\Controller;

class ThnAkademikController extends Controller
{
    public function index()
    {
        $data = TahunAcademic::all();
        return view('dashboard.master.thnakademik.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tahun_akademik' => 'required',
            'semester'     => 'required',
            'status'    => 'required'
        ], [
            'tahun_akademik.required'   => 'Silahkan isi tahun akademik terlebih dahulu!',
            'semester.required' => 'Silahkan isi semester terlebih dahulu!',
            'status.required' => 'Silahkan isi status terlebih dahulu!'
        ]);

        //create post
        TahunAcademic::create([
            'tahun_akademik'     => $request->tahun_akademik,
            'semester'     => $request->semester,
            'status'     => $request->status,
        ]);

        return response()->json([
            'success' => 'Tahun Akademik successfully added',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $data = TahunAcademic::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tahun_akademik' => 'required',
            'status'    => 'required'
        ], [
            'tahun_akademik.required'   => 'Silahkan isi tahun akademik terlebih dahulu!',
            'status.required' => 'Silahkan isi status terlebih dahulu!'
        ]);
        // dd($request->all());

        $data = TahunAcademic::find($id);
        $data->tahun_akademik = $request->tahun_akademik;
        $data->semester = $request->semester;
        $data->status = $request->status;
        $data->save();
        
        return response()->json(['success' => 'Tahun Akademik successfully updated!']);
        
    }

    public function destroy($id)
    {
        TahunAcademic::find($id)->delete();

        return redirect()->route('thnakademik')->with(['success' => 'Tahun Akademik successfully deleted!']);
    }
}
