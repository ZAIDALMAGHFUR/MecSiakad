<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Program_studies;

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
}
