<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'npm',
        'nama',
        'email',
        'semester',
        'foto'
    ];

    public function skripsi(): HasOne
    {
        return $this->hasOne(Skripsi::class);
    }


}
