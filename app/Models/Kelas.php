<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    protected $fillable = ['nama'];

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class, 'kelas_id', 'id');
    }
}
