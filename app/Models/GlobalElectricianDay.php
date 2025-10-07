<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GlobalElectricianDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',

        'story_name',
        'story_image',
        'story_description',

        'mission_name',
        'mission_image',
        'mission_description',

        'matters_name',
        'matters_image',
        'matters_description',
    ];
}
