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
        'breed',
        'location',
        'description',
        'active',
        'adopted',
    ];

    public function getImageAttribute($value)
    {
        if (!$value) {
            return null;
        }
        if (strpos($value, 'data:') === 0 || strpos($value, 'http') === 0) {
            return $value;
        }
        return url('pets/' . $value);
    }
}
