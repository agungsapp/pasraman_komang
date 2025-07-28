<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'siswa_id',
        'tahun',
    ];

    public function details()
    {
        return $this->hasMany(PembayaranDetail::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
