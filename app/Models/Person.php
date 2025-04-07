<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'full_name', 
        'email', 
        'phone_number', 
        'date_of_birth'
    ];
}
