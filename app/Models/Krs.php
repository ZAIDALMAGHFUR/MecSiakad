<?php

namespace App\Models;

use App\Models\TahunAcademic;
use App\Models\Mata_Kuliah;
use App\Models\Program_Studies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Krs extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function program_studies()
    {
        return $this->belongsTo(Program_Studies::class,);
    }

    public function mata_kuliah()
    {
        return $this->belongsTo(Mata_Kuliah::class);
    }

    public function tahun_akademik()
    {
        return $this->belongsTo(TahunAcademic::class);
    }
}
