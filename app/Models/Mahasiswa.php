<?php

namespace App\Models;

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
        return $this->belongsTo(Program_studies::class);
    }

    public function TahunAcademic()
    {
        return $this->belongsTo(TahunAcademic::class);
    }
}
