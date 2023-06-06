<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Timeline;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use App\Models\ProfileUsers;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $guarded = [
         'id'
     ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'users_id', 'id');
    }

    public function ProfileUsers()
    {
        return $this->hasOne(ProfileUsers::class);
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'users_id');
    }

    public function pengumumen()
    {
        return $this->hasMany(Pengumuman::class, 'users_id');
    }

    public function timeline(){
        return $this->hasMany(Timeline::class);
    }
}
