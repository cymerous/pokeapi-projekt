<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// implementation of custom pokemons
class Custompokemons extends Model
{
    protected $fillable = ['name', 'types', 'height', 'weight'];

    protected $casts = [
        'types' => 'array'
    ];
}
