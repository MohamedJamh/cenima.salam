<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\ProductionCompany;
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
        $count = 0;
        $popular_movies = Http::tmdb()->get('/movie/popular')->json()['results'];
        $movie_ids = array_column($popular_movies,'id');

        foreach ($movie_ids as $movie_id) {
            $movie = Http::tmdb()->get('/movie/'.$movie_id)->json();
            $movie_record = Movie::firstOrCreate([
                'id' => $movie['id'],
                'title'=> $movie['title'],
                'tagline'=> $movie['tagline'],
                'budget'=> $movie['budget'],
                'language'=> $movie['original_language'],
                'overview'=> $movie['overview'],
                'release_date'=> $movie['release_date'],
                'runtime'=> $movie['runtime'],
                'rate'=> $movie['vote_average'],
                'status'=> null
            ]);
            foreach ($movie['production_companies'] as $company) {
                ProductionCompany::firstOrCreate([
                    'id' => $company['id'],
                    'name' => $company['name']
                ]);
            }
            $genres = array_column($movie['genres'] , 'id');
            $production_companies = array_column($movie['production_companies'] , 'id');
            
            // $movie_record->genres()->attach($genres);
            $movie_record->productionCompanies()->attach($production_companies);

            $count++;
            if($count == 2) break;
    }

    }
}
