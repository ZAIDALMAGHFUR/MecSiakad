<?php

namespace App\Models;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\TahunAcademic;
use App\Models\Mata_Kuliah;
use App\Models\Program_studies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Khs extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAcademic::class);
    }

    public function mataKuliah ()
    {
        return $this->belongsToMany(Mata_Kuliah::class);
    }

    public function programStudies()
    {
        return $this->belongsTo(Program_studies::class);
    }
}
