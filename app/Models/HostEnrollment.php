<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostEnrollment extends Model

{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'email',
        'phone',
        'annual_income',
        'employee_number',
        'country',
        'city',
        'state',
        'zip_number',
        'parish',
        'county',
        'message',
        'licence_number',
        'licence_agency_url',
        'answers_json',
    ];

    protected $casts = [
        'answers_json' => 'array',
    ];
}

