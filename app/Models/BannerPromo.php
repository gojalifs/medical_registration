<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerPromo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'path',
        'deleted_at'
    ];
}
