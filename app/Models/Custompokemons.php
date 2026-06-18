<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Custompokemons extends Model
{
    protected $fillableData = ['name', 'types', 'height', 'width'];

    protected $types = [
        'types' => 'array'
    ];
}
