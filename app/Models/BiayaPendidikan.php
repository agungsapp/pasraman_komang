<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiayaPendidikan extends Model
{
    protected $fillable = [
        'jenjang_id',
        'komponen_biaya_id',
        'nominal',
    ];

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class);
    }

    public function komponenBiaya()
    {
        return $this->belongsTo(KomponenBiaya::class, 'komponen_biaya_id');
    }

    public function pembayaranDetails()
    {
        return $this->hasMany(PembayaranDetail::class, 'biaya_pendidikan_id');
    }
}
