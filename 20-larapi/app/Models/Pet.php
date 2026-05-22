<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
     protected $fillable = [
        'name',
        'image',
        'kind',
        'weight',
        'age',
        'bread',
        'location',
        'description',
        'active',
        'adopted'
    ];
}
