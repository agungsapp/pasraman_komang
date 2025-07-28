<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    protected $fillable = [
        'siswa_id',
        'pelajaran_id',
        'guru_id',
        'nilai',
        'keterangan',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function pelajaran(): BelongsTo
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
