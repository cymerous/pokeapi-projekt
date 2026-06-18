<?php

namespace App\Http\Controllers;

use App\Models\BannedPokemons;
use App\Models\Custompokemons;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomPokemonController extends Controller
{
    // POST - add custom pokemon
    public function post(Request $req): JsonResponse {
        $req->validate([
            'name' => 'required|string',
            'types' => 'required|array',
            'types.*' => 'string',
            'height' => 'required|integer',
            'weight' => 'required|integer',
        ]);

        $name = strtolower(trim($req->input('name')));

        if (Custompokemons::where('name', $name)->exists()) return response()->json([
            'message' => "Pokemon with name {$name} already exists."
        ], 400);

        $pokemon = CustomPokemons::create([
            'name' => $name,
            'types' => $req->input('types'),
            'height' => $req->input('height'),
            'weight' => $req->input('weight'),
        ]);

        return response()->json($pokemon, 201);
    }
}
