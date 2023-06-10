<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\TahunAcademic;
use App\Models\Program_studies;
use App\Models\Mata_Kuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DosenMatkul extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function tahunAcademic()
    {
        return $this->belongsTo(TahunAcademic::class, 'tahun_academics_id');
    }

    public function programStudies()
    {
        return $this->belongsTo(Program_studies::class, 'program_studies_id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(Mata_Kuliah::class, 'mata_kuliah_id', 'id');
    }
}
