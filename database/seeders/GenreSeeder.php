<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = Http::tmdb()->get('/genre/movie/list')->json()['genres'];
        foreach ($genres as $genre) {
            Genre::firstOrCreate([
                'id' => $genre['id'],
                'name' => $genre['name']
            ]);
        }
    }
}
