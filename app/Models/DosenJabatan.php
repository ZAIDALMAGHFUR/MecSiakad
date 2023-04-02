<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Jabatan;
use App\Models\TahunAcademic;
use App\Models\Program_studies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DosenJabatan extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function tahun_academic()
    {
        return $this->belongsTo(TahunAcademic::class, 'tahun_academics_id');
    }

    public function program_studies()
    {
        return $this->belongsTo(Program_studies::class, 'program_studies_id');
    }
}
