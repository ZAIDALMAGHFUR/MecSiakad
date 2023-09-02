<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Models\Program_studies;
use App\Exports\MahasiswaExport;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\MahasiswatRequest;

class CreateMahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::all();
        return view('dashboard.pengguna.mahasiswa.index', compact('data'));
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $program_studies = Program_studies::all();
        $tahunakademic = TahunAcademic::all();
        return view('dashboard.pengguna.mahasiswa.create', compact('program_studies', 'tahunakademic'));
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
                'email' => $request->email,
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
                'tahun_academics_id' => $request->tahun_academics_id,
                'asal_sekolah' => $request->asal_sekolah,
                'alamat_ortu' => $request->alamat_ortu,
                'no_hp_ortu' => $request->no_hp_ortu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'nama_ayah' => $request->nama_ayah,
                'tahun_lulus' => $request->tahun_lulus,
                'tahun_masuk' => $request->tahun_masuk,
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

        $import = new UsersImport();
        $importedRows = Excel::import($import, $file);

        $importedRows = $import->getImportedRowCount();

        return redirect()->back()->with([
            'success' => 'Data berhasil ditambahkan',
            'alert-type' => 'success',
            'importedRows' => $importedRows
        ]);
    }


    public function exportExcel()
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    public function edit($id)
    {
        $data = Mahasiswa::findOrFail($id);
        $program_studies = Program_studies::all();
        $tahunakademic = TahunAcademic::all();
        return view('dashboard.pengguna.mahasiswa.edit', compact('data', 'program_studies', 'tahunakademic'));
    }


public function update(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required',
        'nim' => 'required',
        'email' => 'required|string|email|max:255',
        'no_hp' => 'required',
        'alamat' => 'required',
        'program_studies_id' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'agama' => 'required',
        'status' => 'required',
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'tahun_masuk' => 'required',
        'nama_ayah' => 'required',
        'nama_ibu' => 'required',
        'pekerjaan_ayah' => 'required',
        'pekerjaan_ibu' => 'required',
        'no_hp_ortu' => 'required',
        'alamat_ortu' => 'required',
        'asal_sekolah' => 'required',
        'tahun_academics_id' => 'required',
    ]);

    $mahasiswa = Mahasiswa::findOrFail($id);

    if ($request->hasFile('foto')) {
        File::delete('storage/'.$mahasiswa->foto);
        $foto = $request->file('foto')->store('foto-mahasiswa', 'public');
        $mahasiswa->foto = $foto;
    }

    $mahasiswa->update($request->except('foto'));

    return redirect()->route('mahasiswa.admin')->with([
        'success' => 'Data berhasil diubah',
        'alert-type' => 'success'
    ]);
}


    public function show($id)
    {
        $data = Mahasiswa::findOrFail($id);
        $ta = TahunAcademic::all();
        return view('dashboard.pengguna.mahasiswa.show', compact('data', 'ta'));
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        File::delete('storage/'. $mahasiswa->foto);
        $mahasiswa->delete();

        $user = User::where('id', '=', $mahasiswa->user_id)->first()->delete();
        //$user->delete();

            return redirect()->back()->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
}
