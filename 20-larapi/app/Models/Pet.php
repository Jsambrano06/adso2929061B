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
        'adopted',
    ];

    public function getImageAttribute($value)
    {
        if (!$value || $value === 'no-image.png' || $value === 'uploaded') {
            return null;
        }
        if (strpos($value, 'data:') === 0 || strpos($value, 'http') === 0) {
            return $value;
        }
        return url('pets/' . $value);
    }
}
