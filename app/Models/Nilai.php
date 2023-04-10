<?php

namespace App\Models;

use App\Models\Mahasiswa;
use App\Models\Program_studies;
use App\Models\Mata_kuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function Mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function Program_studies()
    {
        return $this->belongsTo(Program_studies::class);
    }

    public function Mata_kuliah()
    {
        return $this->belongsTo(Mata_kuliah::class);
    }

}
