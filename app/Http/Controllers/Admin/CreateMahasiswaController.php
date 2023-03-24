<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\Program_studies;
use App\Exports\MahasiswaExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\MahasiswatRequest;

class CreateMahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::all();
        return view('dashboard.master.mahasiswa.index', compact('data'));
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $program_studies = Program_studies::all();
        return view('dashboard.master.mahasiswa.create', compact('program_studies'));
    }

    public function store(MahasiswatRequest $request)
    {
        // dd($request->all())->toArray();

        if($request->validated()){
            $foto = $request->file('foto')->store(
                'foto-mahasiswa', 'public'
            );

            $user = User::create([
                'username' => $request->name,
                'email' => $request->nim,
                'password' => bcrypt($request->tanggal_lahir),
                'roles_id' => '3',
            ]);

            $query = [
                'name' => $request->name,
                'nim' => $request->nim,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'program_studies_id' => $request->program_studies_id,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'status' => $request->status,
                'user_id' => $user->id,
                'foto' => $foto,
            ];

            $user->mahasiswa()->create($query);
        }

        return redirect()->route('mahasiswa.admin')->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file');

        Excel::import(new UsersImport, $file);

        return redirect()->back()->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    public function destroy($id)
    {
        $data = Mahasiswa::findOrFail($id);
        $data->delete();

        return redirect()->back()->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }   
}