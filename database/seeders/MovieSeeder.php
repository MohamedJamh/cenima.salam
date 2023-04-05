<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Image;
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
        $movie = Http::tmdb()
        ->get('/movie/'.$movie_id)->json();
        $movie_record = null;
        try {
            $movie_record = Movie::firstOrCreate([
                'title'=> $movie['title'],
                'budget'=> $movie['budget'],
                'tagline'=> $movie['tagline'],
                'language'=> $movie['original_language'],
                'overview'=> $movie['overview'],
                'release_date'=> $movie['release_date'],
                'runtime'=> $movie['runtime'],
                'rate'=> $movie['vote_average'],
                'status'=> 'popular'
            ]);
        } catch (\Throwable $th) {
            continue;
        }
        $images_base_url = 'https://image.tmdb.org/t/p/original';
        $images = [
            new Image([
                'url' => $images_base_url . $movie['poster_path'],
                'type' => 'poster'
            ]),
            new Image([
                'url' => $images_base_url . $movie['backdrop_path'],
                'type' => 'backdrop'
            ])
        ];
        $company_ids = array();
        foreach ($movie['production_companies'] as $company) {
            $company = ProductionCompany::firstOrCreate([
                'name' => $company['name']
            ]);
            array_push($company_ids,$company->id);
        }

        $genre_ids = array();
        foreach ($movie['genres'] as $genre) {
            $genre = Genre::firstOrCreate([
                'name' => $genre['name']
            ]);
            array_push($genre_ids,$genre->id);
        }
        
        $movie_record->images()->saveMany($images);
        $movie_record->genres()->attach($genre_ids);
        $movie_record->productionCompanies()->attach($company_ids);

        if($count == 10) break;
        $count++;
    }
    }
}
