<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'jenjang_id',
        'kelas_id',
        'nama',
        'nisn', // tambahan baru
        'email',
        'no_orang_tua',
        'nama_orang_tua', // tambahan baru
        'alamat',
        'tanggal_lahir',
        'tempat_lahir', // tambahan baru
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tanggal_lahir' => 'date',
    ];

    public function jenjang(): BelongsTo
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_id');
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }


    public function nilais(): HasMany
    {
        return $this->hasMany(Nilai::class, 'siswa_id', 'id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function pelajaranSiswas()
    {
        return $this->hasMany(PelajaranSiswa::class, 'siswa_id');
    }
}
