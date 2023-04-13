<?php

namespace App\Models;

use App\Models\Mata_Kuliah;
use App\Models\DosenJabatan;
use App\Models\Program_studies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function program_studies()
    {
        return $this->belongsTo(Program_studies::class);
    }

    public function mataKuliahs()
    {
        return $this->hasMany(Mata_Kuliah::class);
    }

    public function dosenJabatans()
    {
        return $this->hasMany(DosenJabatan::class, 'jabatan_id');
    }
}
