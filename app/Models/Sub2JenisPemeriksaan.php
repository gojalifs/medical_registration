<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub2JenisPemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'sub_2_jenis_pemeriksaans';

    protected $fillable = [
        'sub_jenis_pemeriksaan_id',
        'name',
        'created_at',
        'updated_at'
    ];

}
