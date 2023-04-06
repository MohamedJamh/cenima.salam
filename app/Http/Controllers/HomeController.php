<?php

namespace App\Http\Controllers;

use App\Http\Resources\Movie\MovieCollection;
use App\Http\Resources\Showtime\ShowtimeCollection;
use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function popularMovie(){
        $popularMovies = Movie::with(['genres','productionCompanies','images'])
        ->where('status','popular')->get();
        
        return response()->json([
            'status' => true,
            'result' => new MovieCollection($popularMovies)
        ]);
    }
    public function upcomingMovies(){
        $upcomingMovies = Movie::with(['genres','productionCompanies','images'])
        ->where('status','upcoming')->get();
        return response()->json([
            'status' => true,
            'result' => new MovieCollection($upcomingMovies)
        ]);
    }
    public function premierMovies(){
        $premierMovies = Movie::where('status','premier')->get();
        return response()->json([
            'status' => true,
            'result' => new MovieCollection($premierMovies)
        ]);
    }
}
