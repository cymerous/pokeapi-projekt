<?php
namespace App\Services;

use App\Models\BannedPokemons;
use App\Models\CustomPokemons;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PokemonService {
    // downloading informations about pokemons about the custom one and the banned one
    public function getInfo(array $names): array {
        $result = [];

        $parsedNames = array_map(function($n) {
            return strtolower(trim($n));
        }, $names);

        $banned = array_map('strtolower', BannedPokemons::whereIn('name', $parsedNames)->pluck('name')->toArray());
        $customs = CustomPokemons::where('name', $parsedNames)->get();

        foreach ($parsedNames as $name) {
            if (in_array($name, $banned)) continue;

            if ($customs->has($name)) {
                $custom = $customs->get($name);
                $result[] = [
                    'name' => $custom->name,
                    'types' => $custom->types,
                    'height' => $custom->height,
                    'weight' => $custom->weight,
                    'is_custom' => true,
                ];

                continue;
            }

            $cacheKey = "poke_info_{$name}";

            if (Cache::has($cacheKey)) {
                $result[] = Cache::get($cacheKey);
            } else {
                $apiData = $this->fetchPokeApi($name);
                if ($apiData) {
                    Cache::put($cacheKey, $apiData, 24 * 60 * 60);
                    $result[] = $apiData;
                }
            }
        }

        return $result;
    }

    // function for fetching data from poke api
    private function fetchPokeApi(string $name): ?array {
        $url = "https://pokeapi.co/api/v2/pokemon/{$name}";

        $response = Http::timeout(10)->get($url);
        if ($response->failed()) return null;

        $data = $response->json();
        $types = [];
        if (isset($data['types'])) {
            foreach ($data['types'] as $type) {
                $types[] = $type['type']['name'];
            }
        }

        return [
            'name' => $data['name'],
            'types' => $types,
            'height' => $data['height'],
            'weight' => $data['weight'],
            'is_custom' => false
        ];
    }
}
?>
