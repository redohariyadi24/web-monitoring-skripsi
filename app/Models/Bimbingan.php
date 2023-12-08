<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'tanggal',
        'mahasiswa_id',
        'dospem_id',
        'skripsi_id',
        'bab_id',
        'subbab_id',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dospem_id');
    }

    public function skripsi()
    {
        return $this->belongsTo(Skripsi::class);
    }

    public function bab()
    {
        return $this->belongsTo(Bab::class);
    }

    public function subbab()
    {
        return $this->belongsTo(Subbab::class, 'subbab_id');
    }

}
