<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenJabatan extends Model
{
    use HasFactory;

    protected $guarded = [
        'dosen_id',
        'jabatan_id',
        'program_studies_id',
        'tahun_academics_id',
    ];
}
