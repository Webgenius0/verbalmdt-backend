<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalMultimedia extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'images', 'videos'];

    protected $casts = [
        'images' => 'array',
        'videos' => 'array',
    ];
}
