<?php

namespace App\Models;

use App\Models\Krs;
use App\Models\Dosen;
use App\Models\Nilai;
use App\Models\Program_studies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mata_Kuliah extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'mata_kuliahs';


    public function program_studies()
    {
        return $this->belongsTo(Program_Studies::class, 'program_studies_id');
    }

    public function krs()
    {
        return $this->hasMany(Krs::class, 'mata_kuliah_id', 'nim');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mata_kuliahs_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
