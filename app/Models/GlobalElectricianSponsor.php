<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalElectricianSponsor extends Model
{
    use HasFactory;

    protected $table = 'global_electrician_sponsors';

    protected $fillable = [
        'name',
        'company_name',
        'email',
        'phone',
        'country',
        'city',
        'state',
        'zip_number',
        'parish',
        'county',
        'message',
    ];
}
