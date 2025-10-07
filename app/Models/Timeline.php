<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'subtitle', 'name', 'description'];

    // This is crucial for JSON columns
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
    ];

}
