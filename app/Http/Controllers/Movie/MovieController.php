<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Resources\Movie\MovieCollection;
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

    
    public function store(Request $request)
    {
        
    }

    
    public function show($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

  
    public function destroy($id)
    {
        //
    }
}
