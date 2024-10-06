<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemeriksaan',
        'ruang',
    ];

    public function pemeriksaan()
    {
        return $this->hasManyThrough(Sub2JenisPemeriksaan::class, SubJenisPemeriksaan::class);
    }

    public function subJenisPemeriksaan()
    {
        return $this->hasMany(SubJenisPemeriksaan::class);
    }
}
