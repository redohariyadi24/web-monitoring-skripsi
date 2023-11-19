<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skripsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'dosen1_id',
        'dosen2_id',
        'judul',
        'progres'
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dosen1()
    {
        return $this->belongsTo(Dosen::class, 'dosen1_id');
    }

    public function dosen2()
    {
        return $this->belongsTo(Dosen::class, 'dosen2_id');
    }
}
