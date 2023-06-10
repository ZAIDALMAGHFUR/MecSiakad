<?php

namespace App\Models;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Mata_Kuliah;
use App\Models\TahunAcademic;
use App\Models\Program_studies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function Mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswas_id');
    }

    public function Program_studies()
    {
        return $this->belongsTo(Program_studies::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(Mata_Kuliah::class, 'mata_kuliahs_id');
    }

    // public function krs()
    // {
    //     return $this->belongsTo(Krs::class, 'mata_kuliahs_id');
    // }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAcademic::class, 'tahun_academic_id' );
    }

}
