<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Krs;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\BobotNilai;
use App\Models\DosenMatkul;
use App\Models\DosenJabatan;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Models\Mata_Kuliah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EdiNilaiMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        $nilai = Nilai::all();
        return view('dashboard.dosen.edit-nilai.index', compact('mahasiswa', 'nilai'));
    }

    public function change(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        $nilai = Nilai::where('mahasiswas_id', $id)->get();
        $tahun_akademik = TahunAcademic::all();
        // $dosen = Dosen::Where('users_id', Auth::user()->id)->first();

        $user = User::Where('id', Auth::user()->id)->first();

        $sdnJbt = DosenJabatan::where('dosen_id', $user->dosen->id)->first();
        $dosen = Dosen::where('id', $sdnJbt->dosen_id)->first();

        $jbtdsn = DosenJabatan::where('dosen_id', $dosen->id)->first();

        if ($jbtdsn->jabatan_id != '1') {
            $nilaiQuery = Nilai::query()
                ->where('mahasiswas_id', $mahasiswa->id);
            $dsnmatkul = DosenMatkul::where('dosen_id', $dosen->id)
                ->pluck('mata_kuliah_id');
            $nilaiQuery->whereIn('mata_kuliahs_id', $dsnmatkul);
        } else {
            $dsnmatkul = DosenMatkul::where('dosen_id', $dosen->id)->get();
            $turu = Mata_Kuliah::whereIn('program_studies_id', $dsnmatkul->pluck('program_studies_id'))->get()->pluck('id');
            $nilaiQuery = Nilai::query()
                ->whereIn('mata_kuliahs_id', $turu, 'OR')
                ->where('mahasiswas_id', $mahasiswa->id);
                // dd($nilaiQuery);

            // $nilaiQuery = $mahasiswa->protoNilai();
            // $nilais = $mahasiswa->Nilai()->get();
            // dd($nilaiQuery->get()->toArray());

        }


        // $nilaiQuery = Nilai::query()
        //     ->where('mahasiswas_id', $mahasiswa->id);

        if($request->has('tahun_academic_id')){
            $nilaiQuery->where('tahun_academic_id', $request->tahun_academic_id);
        }else{
            $nilaiQuery->whereIn('tahun_academic_id', $tahun_akademik->pluck('id'));
        }

        $nilaiqu = $nilaiQuery->get();

        // dd($nilaiqu);

        return view('dashboard.dosen.edit-nilai.edit', compact('mahasiswa', 'nilai', 'nilaiqu', 'tahun_akademik'));
    }

    public function compensation($id){
        $nilai = Nilai::findOrFail($id);
        return view('dashboard.dosen.edit-nilai.replacement-dosen', compact('nilai'));
    }

    public function update(Request $request, $id){
        // dd($request->all());
        $nilai = Nilai::findOrFail($id);

        $this->validate($request, [
            'tahun_academic_id' => 'required',
            'mahasiswa_id' => 'required',
            'mata_kuliahs_id' => 'required',
            'tugas' => 'required',
            'kuis' => 'required',
            'partisipasi_pembelajaran' => 'required',
            'uts' => 'required',
            'uas' => 'required',
            'nilai_akhir' => 'required',
        ], [
            'tahun_academic_id.required' => 'Silahkan isi tahun akademik terlebih dahulu!',
            'mahasiswa_id.required' => 'Silahkan isi mahasiswa terlebih dahulu!',
            'mata_kuliahs_id.required' => 'Silahkan isi mata kuliah terlebih dahulu!',
            'tugas.required' => 'Silahkan isi tugas terlebih dahulu!',
            'kuis.required' => 'Silahkan isi kuis terlebih dahulu!',
            'partisipasi_pembelajaran.required' => 'Silahkan isi partisipasi pembelajaran terlebih dahulu!',
            'uts.required' => 'Silahkan isi uts terlebih dahulu!',
            'uas.required' => 'Silahkan isi uas terlebih dahulu!',
            'nilai_akhir.required' => 'Silahkan isi nilai akhir terlebih dahulu!',
        ]);


        $nilai->update([
            'tahun_academic_id' => $request->tahun_academic_id,
            'mahasiswas_id' => $request->mahasiswa_id,
            'mata_kuliahs_id' => $request->mata_kuliahs_id,
            'tugas' => $request->tugas,
            'kuis' => $request->kuis,
            'partisipasi_pembelajaran' => $request->partisipasi_pembelajaran,
            'uts' => $request->uts,
            'uas' => $request->uas,
            'nilai_akhir' => $request->nilai_akhir,
        ]);


        return redirect()->route('compensation')->with([
            'info' => 'Data berhasil diubah!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id){
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('compensation')->with([
            'info' => 'Data berhasil dihapus!',
            'alert-type' => 'success'
        ]);
    }
}
