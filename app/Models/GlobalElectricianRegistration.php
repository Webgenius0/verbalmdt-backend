<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalElectricianRegistration extends Model
{
    use HasFactory;

    protected $table = 'global_electrician_registrations';

    /**
     * Mass assignable fields.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'state',
        'city',
        'parish',
        'county',
        'zip_number',
        'message',
    ];
}
