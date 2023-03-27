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
            'tahun_akademik' => 'required|unique:tahun_academics',
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
        //return response()->json($data);

        return view('dashboard.master.thnakademik.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'kd_tahun'     =>
        //     'required|unique:thn_akademiks,kd_tahun,' . $id . ',id_tahun|min:5',
        //     'nm_tahun'     => 'required',
        //     'ket_tahun'    => 'required'
        // ], [
        //     'kd_tahun.required' => 'Silahkan isi kode tahun terlebih dahulu!',
        //     'kd_tahun.unique' => 'Kode tahun sudah digunakan!',
        //     'nm_tahun.required' => 'Silahkan isi nama tahun akademik terlebih dahulu!',
        //     'ket_tahun.required' => 'Silahkan isi keterangan tahun akademik terlebih dahulu!'
        // ]);

        // $data = TahunAcademic::find($id);
        // $data->kd_tahun = $request->kd_tahun;
        // $data->nm_tahun = $request->nm_tahun;
        // $data->ket_tahun = $request->ket_tahun;
        // $data->stts_tahun = $request->stts_tahun;
        // $data->update();
        return response()->json(['success' => 'Tahun Akademik successfully updated!']);
    }

    public function destroy($id)
    {
        TahunAcademic::find($id)->delete();

        return redirect()->route('thnakademik')->with(['success' => 'Tahun Akademik successfully deleted!']);
    }
}
