<?php

namespace App\Http\Controllers;

use App\Models\BannedPokemons;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BannedPokemonController extends Controller
{
    // GET - get all banned pokemons
    public function get(): JsonResponse {
        return response()->json(BannedPokemons::all());
    }

    // POST - ban pokemon
    public function post(Request $req): JsonResponse {
        $req->validate([
            'name' => 'required|string'
        ]);

        $name = strtolower(trim($req->input('name')));

        if (BannedPokemons::whereIn('name', $name)->exists()) return response()->json(['message' => "Pokemon with name {$name} is already banned"], 400);

        $banned = BannedPokemons::create(['name' => $name]);
        return response()->json($banned, 201);
    }

    // DELETE - unban pokemon
    public function remove(string $name): JsonResponse {
        $name = strtolower(trim($name));
        $pokemon = BannedPokemons::whereIn('name', $name)->first();
        if (!$pokemon) return response()->json(['message' => "Pokemon with name {$name} not found."]);

        $pokemon->delete();

        return response()->json(null, 204);
    }
}
