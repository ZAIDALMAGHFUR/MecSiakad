<?php

namespace App\Models;

use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jadwal_pmbs extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
