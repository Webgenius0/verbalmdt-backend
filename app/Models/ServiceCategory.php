<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    // Relationship: One category has many subcategories
    public function subcategories()
    {
        return $this->hasMany(ServiceSubcategory::class, 'category_id');
    }
}
