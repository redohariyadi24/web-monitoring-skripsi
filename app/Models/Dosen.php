<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama',
        'email',
        'foto'
    ];

    public function skripsis1()
    {
        return $this->hasMany(Skripsi::class, 'dosen1_id');
    }

    public function skripsis2()
    {
        return $this->hasMany(Skripsi::class, 'dosen2_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nip', 'npm');
    }

    public function bimbingans()
    {
        return $this->hasMany(Bimbingan::class, 'dospem_id');
    }
}
