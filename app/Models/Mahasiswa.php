<?php

namespace App\Models;

use App\Models\Nilai;
use App\Models\TahunAcademic;
use App\Models\Program_studies;
use App\Models\Mata_kuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';
    protected $guarded = [
        'id'
    ];

    public function program_studies()
    {
        return $this->belongsTo(Program_studies::class);
    }

    public function TahunAcademic()
    {
        return $this->belongsTo(TahunAcademic::class, 'tahun_academics_id');
    }

    public function Nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function MataKuliah()
    {
        return $this->belongsToMany(Mata_kuliah::class, 'nilais', 'mahasiswas_id', 'mata_kuliahs_id',);
    }
}
