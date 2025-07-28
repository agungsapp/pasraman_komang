<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PelajaranSiswa extends Model
{
    protected $fillable = [
        'siswa_id',
        'pelajaran_id',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function pelajaran(): BelongsTo
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }
}
