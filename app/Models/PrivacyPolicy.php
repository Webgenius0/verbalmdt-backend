<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class PrivacyPolicy extends Model
{
    use HasFactory;

    // Table name explicitly define kora, jodi convention follow na hoy
    protected $table = 'privacy_policies';

    // Mass assignable fields
    protected $fillable = [
        'title',
        'sub_title',
        'description',
    ];

    // JSON fields ke automatically cast kora
    protected $casts = [
        'sub_title' => 'array',
        'description' => 'array',
    ];
}
