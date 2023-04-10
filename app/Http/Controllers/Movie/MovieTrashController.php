<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Resources\Movie\MovieCollection;
use App\Http\Resources\Movie\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieTrashController extends Controller
{
    public function trash(){
        $trash_movies = Movie::onlyTrashed()->get();
        return response()->json([
            'status' => true,
            'result' => new MovieCollection($trash_movies)
        ]);
    }
    public function restoreMovie($id){
        $movie = Movie::onlyTrashed()->find($id);
        if($movie){
            $movie->restore();
            return response()->json([
                'status' => true,
                'message' => 'Movie has been restored'
            ]);
        }
        abort(404);
    }
    
    public function forceDeleteMovie($id){
        $movie = Movie::onlyTrashed()->find($id);
        if($movie){

            $this->killRelationships($movie);

            $movie->forceDelete();
            return response()->json([
                'status' => true,
                'message' => 'Movie has been deleted permanently'
            ]);
        }
        abort(404);
    }

    public function restoreAllTrash(){
        $trashed_movies = Movie::onlyTrashed()->restore();
        if($trashed_movies == 0){
            return response()->json([
                'status' => false,
                'message' => 'There is no available trash'
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'All Movies has been restored successfully'
        ]);
    }

    public function forceDeleteAllTrash(){
        if(!Movie::onlyTrashed()->count()){
            return response()->json([
                'status' => false,
                'message' => 'There is no available trash'
            ]);
        };
        $trashed_movies = Movie::onlyTrashed()->get();
        foreach ($trashed_movies as $movie) {
            $this->killRelationships($movie);
            $movie->forceDelete();
        }
        return response()->json([
            'status' => true,
            'message' => 'All trash has been deleted permanently'
        ]);
    }

    public function killRelationships(Movie $movie){
        $movie->genres()->detach();
        $movie->productionCompanies()->detach();
        $movie->images()->delete();
        $movie->users()->detach();
    }
}
