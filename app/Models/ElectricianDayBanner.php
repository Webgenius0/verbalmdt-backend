<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricianDayBanner extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'image'];

    // Optional: full URL accessor
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
