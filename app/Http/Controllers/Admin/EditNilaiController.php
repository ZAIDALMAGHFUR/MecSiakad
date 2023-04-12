<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Http\Controllers\Controller;

class EditNilaiController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        $nilai = Nilai::all();
        return view('dashboard.master.edit-nilai.index', compact('mahasiswa', 'nilai'));
    }

    public function change(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        $nilai = Nilai::where('mahasiswas_id', $id)->get();
        $tahun_akademik = TahunAcademic::all();

        $nilaiQuery = Nilai::query()
            ->where('mahasiswas_id', $mahasiswa->id);

        if($request->has('tahun_academic_id')){
            $nilaiQuery->where('tahun_academic_id', $request->tahun_academic_id);
        }else{
            $nilaiQuery->whereIn('tahun_academic_id', $tahun_akademik->pluck('id'));
        }

        $nilaiqu = $nilaiQuery->get();

        // dd($nilaiqu);

        return view('dashboard.master.edit-nilai.edit', compact('mahasiswa', 'nilai', 'nilaiqu', 'tahun_akademik'));
    }

    public function replacement($id){
        $nilai = Nilai::findOrFail($id);
        return view('dashboard.master.edit-nilai.replacement', compact('nilai'));
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
        

        return redirect()->route('change')->with([
            'info' => 'Data berhasil diubah!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id){
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('change')->with([
            'info' => 'Data berhasil dihapus!',
            'alert-type' => 'success'
        ]);
    }
}
