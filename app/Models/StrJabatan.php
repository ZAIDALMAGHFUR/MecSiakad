<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrJabatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function strukturKepemimpinan()
    {
        return $this->hasMany(StrukturKepemimpinan::class, 'jabatan_id', 'id');
    }
}
