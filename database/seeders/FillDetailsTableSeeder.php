<?php

namespace Database\Seeders;


use App\Models\Detail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FillDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://pokeapi.co/api/v2/type/5?limit=30');

        $jsonData = $response->json();
          
        $pokemons_by_type = array_slice($jsonData['pokemon'], 0, 30);

        foreach ($pokemons_by_type as $pokemon) {
            $stats = Http::get('https://pokeapi.co/api/v2/pokemon/' . $pokemon['pokemon']['name'] . '/')->json();

            Detail::create([
                'nombre' => $stats['name'],
                'experiencia' => $stats['base_experience'],
                'altura' => $stats['height'],
                'peso' => $stats['weight'],
                'imagen' => $stats['sprites']['front_default'],
                'url' => $pokemon['pokemon']['url']
            ]);
        }
    }
}
