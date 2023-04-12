<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image\ImageController;
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

        foreach ($request->input('images') as $image ) {
            $pathOrUrl = $image['url'];
            if(!filter_var($image['url'],FILTER_VALIDATE_URL)){
                $pathOrUrl = (new ImageController)->store($image['url'] , $image['type'] , 'movies/');
            }
            $movie->images()->create([
                'type' => $image['type'],
                'url' => $pathOrUrl
            ]);
        }
        $movie->genres()->attach($request->input('genres'));
        $movie->productionCompanies()->attach($request->input('production_companies'));

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
        // $this->authorize('update',$movie);

        if($request->has('images')){
            foreach ($request->input('images') as $image ) {
                if($image['url'] != null ){
                    // deleting the image
                    $oldImage = $movie->images->where('type',$image['type']);
                    return response()->json([
                        'status' => true,
                        'result' => $oldImage
                    ]);
                    (new ImageController)->destory($oldImage,substr($oldImage->first()->url,32));
                    //adding the new image
                    $pathOrUrl = $image['url'];
                    if(!filter_var($image['url'],FILTER_VALIDATE_URL)){
                        $pathOrUrl = (new ImageController)->store($image['url'] , $image['type'] , 'movies/');
                    }
                    $movie->images()->create([
                        'type' => $image['type'],
                        'url' => $pathOrUrl
                    ]);
                }
            }
        }

        $movie->update(
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
        $movie->genres()->sync($request->input('genres'));
        $movie->productionCompanies()->sync($request->input('production_companies'));

        return response()->json([
            'status' => true,
            'message' => 'Movie details has been updated successfully',
            'result' => new MovieResource($movie)
        ]);
    }

  
    public function destroy(Movie $movie)
    {
        $this->authorize('delete',$movie);

        $movie->delete();
        return response()->json([
            'status' => true,
            'message' => 'Movie has been deleted successfully'
        ]);
    }
}
