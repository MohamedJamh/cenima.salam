<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\StoreMovieRequest;
use App\Http\Requests\Movie\UpdateMovieRequest;
use App\Http\Resources\Movie\MovieCollection;
use App\Http\Resources\Movie\MovieResource;
use App\Models\Genre;
use App\Models\Image;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    
    public function index()
    {
        $movies = Movie::all();
        return response()->json([
            'status' => true,
            'result' =>  new MovieCollection($movies)
        ]);
    }

    
    public function store(StoreMovieRequest $request)
    {
        $movie = Movie::create(
            $request->only([
                'title',
                'budget',
                'tagline',
                'language',
                'overview',
                'release_date',
                'runtime',
                'rate',
                'status',
            ])
        );
        $images = [
            new Image([
                'url' => $request->input('poster_img'),
                'type' => 'poster'
            ]),
            new Image([
                'url' => $request->input('backdrop_img'),
                'type' => 'backdrop'
            ])
        ];
        $movie->genres()->attach($request->input('genres'));
        $movie->productionCompanies()->attach($request->input('production_companies'));
        $movie->images()->saveMany($images);

        return response()->json([
            'status' => true,
            'message' => 'Movie has been added successfully',
            'result' => new MovieResource($movie)
        ]);
    }

    
    public function show(Movie $movie)
    {
        return response()->json([
            'status' => true,
            'result' => new MovieResource(Movie::find($movie->id))
        ]);
    }

    
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $movie->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Movie details has been updated successfully',
            'result' => new MovieResource($movie)
        ]);
    }

  
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json([
            'status' => true,
            'message' => 'Movie has been deleted successfully'
        ]);
    }
}
