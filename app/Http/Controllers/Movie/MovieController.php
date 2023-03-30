<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Resources\Movie\MovieCollection;
use App\Http\Resources\Showtime\ShowtimeCollection;
use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function popularMovie(){
        $popularMovies = Http::tmdb()->get('/movie/popular')->json()['results'];
        return response()->json([
            'status' => true,
            'result' => $popularMovies
        ]);
    }
    public function upcomingMovies(){
        $upcomingMovies = Movie::where('status','upcoming')->get();
        return response()->json([
            'status' => true,
            'result' => new MovieCollection($upcomingMovies)
        ]);
    }
    public function premierMovies(){
        $premierMovies = Showtime::where('date','>=',date('Y-m-d'))->get();
        return response()->json([
            'status' => true,
            'result' => new ShowtimeCollection($premierMovies)
        ]);
    }
}
