<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class PokemonController extends Controller
{
    public function index()
    {
        // $response = Http::get('https://pokeapi.co/api/v2/type/5?limit=30');

        // $jsonData = $response->json();
          
        // $pokemons_by_type = array_slice($jsonData['pokemon'], 0, 30);

        // $pokemons = [];

        // foreach ($pokemons_by_type as $pokemon) {
        //     $stats = Http::get('https://pokeapi.co/api/v2/pokemon/' . $pokemon['pokemon']['name'] . '/')->json();
        //     $pokemons[] = [
        //         'name' => $stats['name'],
        //         'base_experience' => $stats['base_experience'],
        //         'height' => $stats['height'],
        //         'weight' => $stats['weight'],
        //         'front_sprite' => $stats['sprites']['front_default'],
        //         'back_sprite' => $stats['sprites']['back_default'],
        //         'url' => $pokemon['pokemon']['url']
        //     ];
        // }

        // $base_experience = array_column($pokemons, 'base_experience');

        // array_multisort($base_experience, SORT_DESC, $pokemons);

        $pokemons = Detail::orderBy('experiencia', 'ASC')->get();

        return view('PokemonList',
            [
                'pokemons' => $pokemons,
                'details' => null
            ]
        );
    }

    public function details($id)
    {
        // $response = Http::get('https://pokeapi.co/api/v2/type/5?limit=30&offset=10');

        // $jsonData = $response->json();
          
        // $pokemons_by_type = array_slice($jsonData['pokemon'], 0, 30);

        // $pokemons = [];

        // foreach ($pokemons_by_type as $pokemon) {
        //     $stats = Http::get('https://pokeapi.co/api/v2/pokemon/' . $pokemon['pokemon']['name'] . '/')->json();
        //     $pokemons[] = [
        //         'name' => $stats['name'],
        //         'base_experience' => $stats['base_experience'],
        //         'height' => $stats['height'],
        //         'weight' => $stats['weight'],
        //         'front_sprite' => $stats['sprites']['front_default'],
        //         'back_sprite' => $stats['sprites']['back_default'],
        //         'url' => $pokemon['pokemon']['url']
        //     ];
        // }

        // $base_experience = array_column($pokemons, 'base_experience');

        // array_multisort($base_experience, SORT_DESC, $pokemons);

        $pokemons = Detail::orderBy('id', 'DESC')->get();

        if ($id) {
            $details = Http::get('https://pokeapi.co/api/v2/pokemon/' . $id . '/')->json();
        } else {
            $details = Http::get('https://pokeapi.co/api/v2/pokemon/27/')->json();
        }

        return view('PokemonList',
            [
                'pokemons' => $pokemons,
                'details' => $details,
            ]
        );
    }
}
