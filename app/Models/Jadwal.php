<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'skripsi_id',
        'jenis',
    ];

    public function skripsi()
    {
        return $this->belongsTo(Skripsi::class);
    }
}
