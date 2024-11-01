<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemeriksaan_id',
        'analyst_id',
        'hasil',
        'keterangan',
        'sub_jenis_id',
        'sub_2_jenis_id',
    ];
}
