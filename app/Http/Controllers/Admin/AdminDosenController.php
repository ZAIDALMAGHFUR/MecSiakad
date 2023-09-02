<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Dosen;
use App\Exports\DosenExport;
use App\Imports\DosenImport;
use Illuminate\Http\Request;
use App\Models\Program_studies;
use App\Http\Requests\DosenRequest;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AdminDosenController extends Controller
{
    public function index()
    {
        $data = Dosen::all();
        return view('dashboard.pengguna.dosen.index', compact('data'));
    }

    public function add()
    {
        $program_studies = Program_studies::all();
        return view('dashboard.pengguna.dosen.create', compact('program_studies'));
    }

    public function store(DosenRequest $request)
    {
        if ($request->validated()) {
            $foto = $request->file('photo')->store(
                'foto-dosen', 'public'
            );

            $user = User::create([
                'username' => $request->nama_dosen,
                'email' => $request->email,
                'password' => bcrypt($request->nidn),
                'roles_id' => '2',
            ]);

            $query = [
                'kode_dosen' => $request->kode_dosen,
                'nama_dosen' => $request->nama_dosen,
                'nidn' => $request->nidn,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'program_studies_id' => $request->program_studies_id,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'photo' => $foto,
                'users_id' => $user->id,
            ];

            Dosen::create($query);
            return redirect()->route('dosen/admin')->with([
                'success' => 'Data berhasil ditambahkan',
                'alert-type' => 'success'
            ]);
        }
    }

    public function edit($id)
    {
        $data = Dosen::findOrFail($id);
        $program_studies = Program_studies::all();
        return view('dashboard.pengguna.dosen.edit', compact('data', 'program_studies'));
    }

    public function update(DosenRequest $request, $id)
    {
        if ($request->validated()) {
            $data = Dosen::findOrFail($id);
            $foto = $request->file('photo')->store(
                'foto-dosen', 'public'
            );

            $user = User::findOrFail($data->users_id);
            $user->update([
                'username' => $request->nama_dosen,
                'email' => $request->email,
                'password' => bcrypt($request->nidn),
                'roles_id' => '2',
            ]);

            $query = [
                'kode_dosen' => $request->kode_dosen,
                'nama_dosen' => $request->nama_dosen,
                'nidn' => $request->nidn,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'program_studies_id' => $request->program_studies_id,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'photo' => $foto,
                'users_id' => $user->id,
            ];

            $data->update($query);
            return redirect()->route('dosen/admin')->with([
                'success' => 'Data berhasil diubah',
                'alert-type' => 'success'
            ]);
        }
    }

    public function show($id)
    {
        $data = Dosen::findOrFail($id);
        return view('dashboard.pengguna.dosen.show', compact('data'));
    }

    public function destroy($id)
    {
        $data = Dosen::findOrFail($id);
        $data->delete();
        return redirect()->route('dosen/admin')->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new DosenExport, 'dosen.xlsx');
    }


    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file');

        Excel::import(new DosenImport, $file);

        return redirect()->back()->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        ]);
    }
}
