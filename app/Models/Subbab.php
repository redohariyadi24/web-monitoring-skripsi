<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subbab extends Model
{
    use HasFactory;
    public function bab()
    {
        return $this->belongsTo(Bab::class);
    }

    public function bimbingans()
    {
        return $this->hasMany(Bimbingan::class, 'subbab_id');
    }
}
