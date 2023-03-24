<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // add your tmdb api key to env file under the name of TMDB_TOKEN
        $popular_movies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/popular')
        ->json()['results'];
        $movie_ids = array_column($popular_movies,'id');

        foreach ($movie_ids as $id) {
            Movie::create([
                'id' => $id 
            ]);
        }

    }
}
