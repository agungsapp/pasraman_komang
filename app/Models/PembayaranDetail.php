<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranDetail extends Model
{
    protected $fillable = [
        'pembayaran_id',
        'biaya_pendidikan_id',
        'jumlah',
    ];


    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    public function biayaPendidikan()
    {
        return $this->belongsTo(BiayaPendidikan::class);
    }
}
