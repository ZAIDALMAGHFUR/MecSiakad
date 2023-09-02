<?php

// namespace App\Http\Controllers\Dosen;

// use App\Models\Krs;
// use App\Models\Dosen;
// use App\Models\Nilai;
// use App\Models\Mahasiswa;
// use App\Models\BobotNilai;
// use App\Models\DosenMatkul;
// use Illuminate\Http\Request;
// use App\Models\TahunAcademic;
// use App\Models\Mata_Kuliah;
// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Validator;

// class NilaiController extends Controller
// {
//     public function index()
//     {   
//         $mahasiswa = Mahasiswa::all();
//         $nilai = Nilai::all();
//         return view('dashboard.dosen.input-nilai.index', compact('mahasiswa', 'nilai'));
//     }




//     public function find(Request $request, $id){
//         // dd(TahunAcademic::all()->toArray());
//         $bobot = BobotNilai::all();
//         $mahasiswa = Mahasiswa::where('id', $id)->first();
//         $tahun_akademik = TahunAcademic::all();
//         $dosen = Dosen::Where('users_id', Auth::user()->dosen->id)->first();

//         // dd($dosen->dosenJabatans()->first()->toArray());
        
//         if ($dosen->dosenJabatans()->first()->jabatan_id != '1') {
//             $krsQuery = Krs::query()
//                 ->where('nim', $mahasiswa->nim);
//             $dsnmatkul = DosenMatkul::where('dosen_id', $dosen->id)
//                 ->pluck('mata_kuliah_id');
//             $krsQuery->whereIn('mata_kuliah_id', $dsnmatkul);
//         } else {
//             $dsnmatkul = DosenMatkul::where('dosen_id', $dosen->id)->get();
//             // dd($dsnmatkul);
//             $id_kepala_prodi = $dosen->dosenJabatans()->first()->program_studies_id;
//             // dd($id_kepala_prodi);
//             $turu = Mata_Kuliah::where('program_studies_id', $id_kepala_prodi)
//             ->whereIn('id', $dsnmatkul->pluck('mata_kuliah_id'), 'OR')
//             ->get()->pluck('id');
//             // dd($turu);
//             $krsQuery = Krs::query()
//                 ->whereIn('mata_kuliah_id', $turu, 'OR')
//                 ->where('nim', $mahasiswa->nim);
//                 // dd($krsQuery);
//         }
    
//         if($request->has('tahun_academic_id')){
//             $krsQuery->where('tahun_academic_id', $request->tahun_academic_id);
//             $nilais = Nilai::where('mahasiswas_id', $id)
//             ->where('tahun_academic_id', $request->tahun_academic_id)
//             ->get()
//             ->toArray();
//         }else{
//             $krsQuery->whereIn('tahun_academic_id', $tahun_akademik->pluck('id'));
//             $nilais = Nilai::where('mahasiswas_id', $id)
//             ->get()
//             ->toArray();
//         }
    
//         $krs = $krsQuery->get();



//     return view('dashboard.dosen.input-nilai.edit', compact('mahasiswa', 'krs', 'tahun_akademik', 'bobot', 'nilais'));

//     }



//     public function update(Request $request)
// {
    
//     $validator = Validator::make($request->all(), [
//         'tahun_academic_id.*' => 'required',
//         'mahasiswa_id.*' => 'required',
//         'mata_kuliahs_id.*' => 'required',
//         'tugas.*' => 'required',
//         'kuis.*' => 'required',
//         'partisipasi_pembelajaran.*' => 'required',
//         'uts.*' => 'required',
//         'uas.*' => 'required',
//         'nilai_akhir.*' => 'required',
//     ]);

//     if ($validator->fails()) {
//         return redirect()->back()
//             ->withErrors($validator)
//             ->withInput()
//             ->with('error', 'Nilai gagal disimpan.');
//     }

//     $tahun_academic_id = $request->input('tahun_academic_id');
//     $mahasiswa_id = $request->input('mahasiswa_id');
//     $mata_kuliahs_id = $request->input('mata_kuliahs_id');
//     $tugas = $request->input('tugas');
//     $partisipasi_pembelajaran = $request->input('partisipasi_pembelajaran');
//     $kuis = $request->input('kuis');
//     $uts = $request->input('uts');
//     $uas = $request->input('uas');
//     $nilai_akhir = $request->input('nilai_akhir');

//     // loop through the input arrays to create the new records
//     $total = count($tugas) - 1;
//     for ($key = 0; $key <= $total ; $key++) {
//         $nilai = new Nilai;
//         $nilai->    tahun_academic_id = $tahun_academic_id[$key];
//         $nilai->mahasiswas_id = $mahasiswa_id[$key];
//         $nilai->mata_kuliahs_id = $mata_kuliahs_id[$key];
//         $nilai->tugas = $tugas[$key];
//         $nilai->partisipasi_pembelajaran = $partisipasi_pembelajaran[$key];
//         $nilai->kuis = $kuis[$key];
//         $nilai->uts = $uts[$key];
//         $nilai->uas = $uas[$key];
//         $nilai->nilai_akhir = $nilai_akhir[$key];
//         $nilai->save();
//     }

//     return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
// }
// }




namespace App\Http\Controllers\Dosen;

use App\Models\User;
use App\Models\Krs;
use App\Models\Dosen;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\DosenJabatan;
use App\Models\BobotNilai;
use App\Models\DosenMatkul;
use Illuminate\Http\Request;
use App\Models\TahunAcademic;
use App\Models\Mata_Kuliah;
use App\Models\Program_studies;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $nilai = Nilai::all(); //mengambil semua data nilai
        $thn = TahunAcademic::all();
        $prodi = Program_studies::all();
        // $matkul = DosenMatkul::where('dosen_id', Auth::user()->dosen->id)->mataKuliah()->get();;
        // dd($matkul);

        // $user = User::Where('id', Auth::user()->id)->first();
        $dsnmatkul = DosenMatkul::where('dosen_id', Auth::user()->dosen->id)->get();
        // dd($dsnmatkul);

        $matkul = [];
        foreach ($dsnmatkul as $key => $value) {
            $matkul[] = $value->mataKuliah;
        }
        // dd($matkul);

        $mahasiswa = Mahasiswa::query();
        if ($request->tahun_academics_id && $request->mata_kuliah_id) {
            $krs = Krs::where('mata_kuliah_id', $request->mata_kuliah_id)->pluck('nim');

            $mahasiswa->where('tahun_academics_id', $request->tahun_academics_id)
                ->whereIn('nim', $krs);
        } elseif ($request->tahun_academics_id) {
            $mahasiswa->where('tahun_academics_id', $request->tahun_academics_id);
        } elseif ($request->mata_kuliah_id) {
            $krs = Krs::where('mata_kuliah_id', $request->mata_kuliah_id)->pluck('nim');
            $mahasiswa->whereIn('nim', $krs);
        }
        // dd($mahasiswa->get()->toArray());
        $mahasiswa = $mahasiswa->get();

        $cetak = (object)[];
        $cetak->ta = $request->tahun_academics_id ?? '0';
        $cetak->matkul = $request->mata_kuliah_id ?? '0';


        return view('dashboard.dosen.input-nilai.index', compact('mahasiswa', 'nilai', 'thn', 'prodi', 'matkul', 'cetak'));
    }




    public function find(Request $request, $id){
        // dd(TahunAcademic::all()->toArray());
        $bobot = BobotNilai::all();
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        $tahun_akademik = TahunAcademic::all();
        //$dosen = Dosen::Where('users_id', Auth::user()->id)->first();
        $user = User::Where('id', Auth::user()->id)->first();

        $sdnJbt = DosenJabatan::where('dosen_id', $user->dosen->id)->first();
        $dosen = Dosen::where('id', $sdnJbt->dosen_id)->first();

        $jbtdsn = DosenJabatan::where('dosen_id', $dosen->id)->first();
        // dd($jbtdsn->jabatan_id);


        // dd($user->dosen->dosenJabatans()->first());
        if ($jbtdsn->jabatan_id != '1') {
            $krsQuery = Krs::query()
                ->where('nim', $mahasiswa->nim);
            $dsnmatkul = DosenMatkul::where('dosen_id', $dosen->id)
                ->pluck('mata_kuliah_id');
            $krsQuery->whereIn('mata_kuliah_id', $dsnmatkul);
        } else {
            $dsnmatkul = DosenMatkul::where('dosen_id', $dosen->id)->get();
            $id_kepala_prodi = $jbtdsn->program_studies_id;
            $turu = Mata_Kuliah::where('program_studies_id', $id_kepala_prodi)
            ->whereIn('id', $dsnmatkul->pluck('mata_kuliah_id'), 'OR')
            ->get()->pluck('id');
            $krsQuery = Krs::query()
                ->whereIn('mata_kuliah_id', $turu, 'OR')
                ->where('nim', $mahasiswa->nim);
                // dd($krsQuery->get()->toArray());
        }

        if($request->has('tahun_academic_id')){
            $krsQuery->where('tahun_academic_id', $request->tahun_academic_id);
            // $nilais = Nilai::where('mahasiswas_id', $id)
            // ->where('tahun_academic_id', $request->tahun_academic_id)
            // ->get()
            // ->toArray();
        }else{
            $krsQuery->whereIn('tahun_academic_id', $tahun_akademik->pluck('id'));
            // $nilais = Nilai::where('mahasiswas_id', $id)
            // ->get()
            // ->toArray();
        }

        $krs = $krsQuery->with('nilai')->get();
        // dd($krs->toArray());
        if ($krs->isEmpty()) {
            return redirect()->back()->with([
                'info' => "Mahasiswa belum mengambil krs di tahun ini",
                'alert-type' => "info"
            ]);
        }
        // dd($krs);
        for ($i=0; $i < count($krs); $i++) {
            // dd(json_encode($krs, JSON_PRETTY_PRINT));
            $nilai[$i]['tugas'] = isset($krs[$i]->nilai[0]->tugas) ? $krs[$i]->nilai[0]->tugas : '';
            $nilai[$i]['kuis'] = isset($krs[$i]->nilai[0]->kuis) ? $krs[$i]->nilai[0]->kuis : '';
            $nilai[$i]['partisipasi_pembelajaran'] = isset($krs[$i]->nilai[0]->partisipasi_pembelajaran) ? $krs[$i]->nilai[0]->partisipasi_pembelajaran : '';
            $nilai[$i]['uts'] = isset($krs[$i]->nilai[0]->uts) ? $krs[$i]->nilai[0]->uts : '';
            $nilai[$i]['uas'] = isset($krs[$i]->nilai[0]->uas) ? $krs[$i]->nilai[0]->uas : '';
            $nilai[$i]['nilai_akhir'] = isset($krs[$i]->nilai[0]->nilai_akhir) ? $krs[$i]->nilai[0]->nilai_akhir : '';
        }
        //  dd($krs);
        $ta_krs = $krs->first()->tahun_academic_id ?? '';

        // dd($ta_krs);


    return view('dashboard.dosen.input-nilai.edit', compact('mahasiswa', 'krs', 'tahun_akademik', 'bobot', 'nilai', 'ta_krs'));

    }



    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_academic_id.*' => 'required',
            'mahasiswa_id.*' => 'required',
            'mata_kuliahs_id.*' => 'required',
            'tugas.*' => 'required',
            'kuis.*' => 'required',
            'partisipasi_pembelajaran.*' => 'required',
            'uts.*' => 'required',
            'uas.*' => 'required',
            'nilai_akhir.*' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Nilai gagal disimpan.');
        }

        $tahun_academic_id = $request->input('tahun_academic_id');
        $mahasiswa_id = $request->input('mahasiswa_id');
        $mata_kuliahs_id = $request->input('mata_kuliahs_id');
        $tugas = $request->input('tugas');
        $partisipasi_pembelajaran = $request->input('partisipasi_pembelajaran');
        $kuis = $request->input('kuis');
        $uts = $request->input('uts');
        $uas = $request->input('uas');
        $nilai_akhir = $request->input('nilai_akhir');

          //dd($request);
        // loop through the input arrays to create the new records
        // $total = count($tugas) - 1;
        foreach ($tugas as $key => $value) {
            // if (!isset($mata_kuliahs_id[$key])) {
            //     continue; // Skip if mata_kuliahs_id is not set
            // }

            $nilai = new Nilai;
            $nilai->tahun_academic_id = $tahun_academic_id;
            $nilai->mahasiswas_id = $mahasiswa_id;
            $nilai->mata_kuliahs_id = $key;
            $nilai->tugas = $tugas[$key];
            $nilai->partisipasi_pembelajaran = $partisipasi_pembelajaran[$key];
            $nilai->kuis = $kuis[$key];
            $nilai->uts = $uts[$key];
            $nilai->uas = $uas[$key];
            $nilai->nilai_akhir = $nilai_akhir[$key];
            $nilai->save();
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }


    public function export(Request $request)
    {
        $matkul_id = $request->matkul;
        $tahun_akademik_id = $request->ta;
        // dd($matkul_id, $tahun_akademik_id);

        if($matkul_id == 0&& $tahun_akademik_id == 0){
            return redirect()->back()->with('error', 'Silahkan pilih tahun akademik dan mata kuliah terlebih dahulu.');
        }

        $data = TahunAcademic::all();
        $prodi = Program_studies::all();
        $matkul = Mata_Kuliah::all();
        $user = User::Where('id', Auth::user()->id)->first();
        $dosen = Dosen::Where('users_id', $user->id)->first();
        $dsnmatkul = DosenMatkul::where('dosen_id', $dosen->id)->get();
        $nilai = Nilai::query();
        $nilai->where('tahun_academic_id', $tahun_akademik_id);

        if ($tahun_akademik_id && $matkul_id != 0) {
            $nilai = $nilai->where('mata_kuliahs_id', $matkul_id);
            $nilai = $nilai->get();
            // dd ($nilai);
            if ($nilai->count() == 0) {
                return redirect()->back()->with('error', 'Data tidak ditemukan ! silahkan isi nilai terlebih dahulu atau pilih tahun akademik dan mata kuliah yang lain.');
            }
        }

        // dd ($nilai);

        // return view('dashboard.dosen.input-nilai.cetak', compact('nilai', 'data', 'prodi', 'matkul', 'dsnmatkul', 'dosen'));
        return pdf::loadHTML(view('dashboard.dosen.input-nilai.cetak', compact('nilai', 'data', 'prodi', 'matkul', 'dsnmatkul', 'dosen')))->download('nilai.pdf');
    }
}
