<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'farm_name',
        'first_name',
        'last_name',
        'business_id',
        'street_address',
        'city',
        'province',
        'postal_code',
        'phone',
        'farm_description',
    ];
}
