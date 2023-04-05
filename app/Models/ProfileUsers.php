<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfileUsers extends Model
{
    use HasFactory;

    protected $table = 'profileusers';

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'foto',
        'tempat_lahir',
        'tanggal_lahir',
        'gender',
        'no_hp',
        'alamat',
        'whatsapp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
