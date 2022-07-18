<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'name',
        'height',
        'mass',
        'hair_color',
        'skin_color',
        'eye_color',
        'birth_year',
        'gender',
        'external_id',
        'planet_id'
    ];

    public function planet()
    {
        return $this->hasOne(Planet::class,'id','planet_id');
    }

    public function starships()
    {
        return $this->belongsToMany(Starship::class);
    }

}
