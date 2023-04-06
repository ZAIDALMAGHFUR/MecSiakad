<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timeline extends Model
{
    use HasFactory;

    protected $table = "timeline";
    protected $primaryKey= "id";
    protected $fillable = ["status","pesan"];
    public $timestamps = false;

    // public function user()
    // {
    //      return $this->belongsTo(User::class, 'user_id');
    // }
}
