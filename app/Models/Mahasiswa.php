<?php

namespace App\Models;

use App\Models\Krs;
use App\Models\Nilai;
use App\Models\Mata_kuliah;
use App\Models\TahunAcademic;
use App\Models\Program_studies;
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
        return $this->belongsTo(Program_studies::class, 'program_studies_id');
    }

    public function TahunAcademic()
    {
        return $this->belongsTo(TahunAcademic::class, 'tahun_academics_id');
    }

    public function Nilai()
    {
        return $this->hasMany(Nilai::class);
    }
    
    public function protoNilai()
    {
        return $this->hasMany(Nilai::class, 'mahasiswas_id');
    }

    public function MataKuliah()
    {
        return $this->belongsToMany(Mata_kuliah::class, 'nilais', 'mahasiswas_id', 'mata_kuliahs_id',);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class, 'mahasiswas_id', 'nim');
    }

    public function mata_kuliah()
{
    return $this->belongsTo(MataKuliah::class);
}

}
