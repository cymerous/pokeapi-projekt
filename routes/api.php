<?php

use App\Http\Controllers\BannedPokemonController;
use App\Http\Controllers\CustomPokemonController;
use App\Http\Controllers\PokemonInfoController;
use Illuminate\Support\Facades\Route;

// public endpoint where user gets information about pokemons
Route::post('/info', [PokemonInfoController::class, 'getInfo']);

Route::middleware(\App\Http\Middleware\VerifyAdminKey::class)->group(function () {
    Route::get('/banned', [BannedPokemonController::class, 'get']);
    Route::post('/banned', [BannedPokemonController::class, 'post']);
    Route::delete('/banned/{name}', [BannedPokemonController::class, 'remove']);
    Route::post('/pokemon', [CustomPokemonController::class, 'post']);
});
