<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelajaran',
        'tahun_ajaran',
        'is_active',
    ];

    public function pelajaranSiswas()
    {
        return $this->hasMany(PelajaranSiswa::class, 'pelajaran_id');
    }

    public function gurus()
    {
        return $this->belongsToMany(User::class, 'guru_pelajarans', 'pelajaran_id', 'guru_id');
    }
}
