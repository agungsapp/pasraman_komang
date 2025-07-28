<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BiayaPendidikan extends Model
{
    protected $fillable = [
        'jenjang_id',
        'komponen_biaya_id',
        'nominal'
    ];

    public function jenjang(): BelongsTo
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_id');
    }

    public function komponen(): BelongsTo
    {
        return $this->belongsTo(KomponenBiaya::class, 'komponen_biaya_id');
    }
}
