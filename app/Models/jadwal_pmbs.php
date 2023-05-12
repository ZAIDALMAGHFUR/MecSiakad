<?php

namespace App\Models;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jadwal_pmbs extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $fillable = ["id_kegiatan", "nama_kegiatan", "jenis_kegiatan", "tgl_mulai", "tgl_akhir", 'brosur', 'description'];
    public $timestamps = false;

    public static function id()
    {
        $kode = DB::table('jadwal_kegiatan')->max('id');
        $addNol = '';
        $kode = str_replace("JDW", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        if (strlen($kode) == 1) {
            $addNol = "00";
        } elseif (strlen($kode) == 2) {
            $addNol = "0";
        }
        $kodeBaru = "JDW" . $addNol . $incrementKode;
        return $kodeBaru;
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
