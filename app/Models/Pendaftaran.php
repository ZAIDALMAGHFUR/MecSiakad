<?php

namespace App\Models;

use App\Models\jadwal_pmbs;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Pengumuman;
use App\Models\Program_studies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function user()
    {
         return $this->belongsTo(User::class, 'user_id');
    }

     public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class);
    }

    public function jadwal_pmbs(){
        return $this->belongsTo(jadwal_pmbs::class,'jadwal_pmbs_id');
    }

    public function pilihan1(){
        return $this->belongsTo(Program_studies::class,'pil1');
    }

    public function pilihan2(){
        return $this->belongsTo(Program_studies::class,'pil2');
    }
}
