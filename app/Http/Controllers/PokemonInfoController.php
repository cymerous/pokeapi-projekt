<?php

namespace App\Http\Controllers;

use App\Models\BannedPokemons;
use App\Services\PokemonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PokemonInfoController extends Controller
{
    protected $pokemonService;

    // construction of an controller with injecting pokemon service
    public function __construct(PokemonService $pokemonService) {
        $this->pokemonService = $pokemonService;
    }

    // public endpoint for downloading pokemon data
    public function getInfo(Request $req): JsonResponse {
        $req->validate([
            'pokemon_names' => 'required|array',
            'pokemon_names.*' => 'string'
        ]);

        $names = $req->input('pokemon_names');
        $pokemons = $this->pokemonService->getInfo($names);
        return response()->json([
            'count' => count($pokemons),
            'pokemons' => $pokemons
        ]);
    }
}
