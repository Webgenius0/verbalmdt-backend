<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = ['title', 'sub_title', 'description'];

    protected $casts = [
        'sub_title' => 'array',
        'description' => 'array',
    ];
}
