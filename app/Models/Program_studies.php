<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pengumuman;
use App\Models\Pendaftaran;
use App\Models\Mata_Kuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program_studies extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function matakuliah()
    {
        return $this->hasMany(Mata_Kuliah::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    public function pengumuman()
    {
    return $this->belongsTo(Pengumuman::class);
    }
    
    public function pendaftaran(){
        return $this->hasMany(Pendaftaran::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
