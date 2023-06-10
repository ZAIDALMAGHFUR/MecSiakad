<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Mata_Kuliah;
use App\Models\TahunAcademic;
use App\Models\Program_Studies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Krs extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function program_studies()
    {
        return $this->belongsTo(Program_Studies::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(Mata_Kuliah::class);
    }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAcademic::class, 'tahun_academic_id', );
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswas_id', 'nim');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mata_kuliahs_id', 'mata_kuliah_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
