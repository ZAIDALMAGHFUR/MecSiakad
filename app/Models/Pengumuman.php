<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Program_studies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
 	}
     public function Program_studies()
     {
         return $this->belongsTo(Program_studies::class, 'prodi_penerima');
      }
    public function user()
    {
         return $this->belongsTo(User::class, 'users_id');
    }
}
