<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mata_Kuliah extends Model
{
    use HasFactory;

    protected $guarded = [
        'name_mata_kuliah',
        'sks',
        'program_study_id',
    ];

    protected $table = 'mata_kuliahs';
}
