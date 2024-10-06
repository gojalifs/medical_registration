<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubJenisPemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'sub_jenis_pemeriksaans';

    protected $fillable = [
        'jenis_pemeriksaan_id',
        'name',
        'created_at',
        'updated_at'
    ];

    public function sub2JenisPemeriksaan()
    {
        return $this->hasMany(Sub2JenisPemeriksaan::class);
    }
}
