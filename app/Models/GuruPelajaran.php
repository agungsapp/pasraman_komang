<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuruPelajaran extends Model
{
    protected $fillable = [
        'guru_id',
        'pelajaran_id'
    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function pelajaran(): BelongsTo
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }
}
