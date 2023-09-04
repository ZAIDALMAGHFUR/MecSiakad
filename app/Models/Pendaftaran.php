<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Pengumuman;
use App\Models\jadwal_pmbs;
use App\Models\Program_studies;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public static function id()
    {
        $data = DB::table('pendaftarans')->orderby('id_pendaftaran','DESC')->first();
        if ($data) {
        $kodeakhir5 = substr($data->id_pendaftaran,-4);
        } else {
            $kodeakhir5 = '0000';
        }
        $kodeku= (int)$kodeakhir5;
        $addNol = '';
        $kodetb = 'PENDPSB';
        $kode = (int)$kodeku + 1;

        if (strlen($kode) == 1) {
            $addNol = "000";
        } elseif (strlen($kode) == 2) {
            $addNol = "00";
        } elseif (strlen($kode) == 3) {
            $addNol = "0";
        } elseif (strlen($kode) == 4) {
            $addNol = "";
        }
        $kodeBaru = $kodetb.now()->format('y').$addNol.$kode;
        return $kodeBaru;
    }

public function tes (){
    return $this->belongsTo(User::class, 'users_id');
}
    public function user()
    {
         return $this->belongsTo(User::class, 'users_id');
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
