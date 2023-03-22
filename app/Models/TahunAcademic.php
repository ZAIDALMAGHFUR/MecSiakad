<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAcademic extends Model
{
    use HasFactory;

    protected $guarded = [
        'tahun_akademik',
    ];
}
