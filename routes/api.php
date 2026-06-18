<?php

use App\Http\Controllers\PokemonInfoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/info', [PokemonInfoController::class, 'getInfo']);
