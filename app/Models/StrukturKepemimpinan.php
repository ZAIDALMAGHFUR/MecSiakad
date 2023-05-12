<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StrukturKepemimpinan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(StrJabatan::class);
    }
}
