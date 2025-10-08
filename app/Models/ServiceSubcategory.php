<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
    ];

    // Relationship to ServiceCategory
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }
}
