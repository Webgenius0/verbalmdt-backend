<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricianDayImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
    ];

    // Optional accessor to get full URL in views/controllers: $item->image_url
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
