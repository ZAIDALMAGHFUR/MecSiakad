<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfileUsers extends Model
{
    use HasFactory;

    protected $table = 'profile_users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
