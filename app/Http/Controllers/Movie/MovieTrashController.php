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
    
    public function forceDelete($id){
        $movie = Movie::onlyTrashed()->find($id);
        if($movie){
            $movie->forceDelete();
            return response()->json([
                'status' => true,
                'message' => 'Movie has been deleted permanently'
            ]);
        }
        abort(404);
    }
}
