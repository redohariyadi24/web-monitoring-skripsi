<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bab extends Model
{
    use HasFactory;
    
    public function subbabs()
    {
        return $this->hasMany(Subbab::class);
    }

    public function bimbingans()
    {
        return $this->hasMany(Bimbingan::class, 'bab_id');
    }
}
