<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{

    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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
        'adopted'
    ];

    //RelationShip:
    //Pet has one Adoptions
    public function adoptions() {
        return $this->hasOne(Adoption::class);
    }

    // Scope Kinds - CORREGIDO
    public function scopeKinds($query, $q){
    if(trim($q)) {
        $query->where('name', 'LIKE', "%$q%")
              ->orWhere('kind', 'LIKE', "%$q%")
              ->orWhere('breed', 'LIKE', "%$q%")
              ->orWhere('location', 'LIKE', "%$q%")
              ->orWhere('description', 'LIKE', "%$q%");
    }
    return $query;
}
}
