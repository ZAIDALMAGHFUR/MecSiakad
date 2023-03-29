<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Program_studies;

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
}
