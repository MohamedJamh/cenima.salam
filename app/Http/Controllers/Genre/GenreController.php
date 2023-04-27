<?php

namespace App\Http\Controllers\Genre;

use App\Http\Controllers\Controller;
use App\Http\Requests\Genre\GenreRequest;
use App\Http\Requests\Genre\UpadateGenreRequest;
use App\Http\Resources\Genre\GenreCollection;
use App\Http\Resources\Genre\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{

    public function __construct(){
        $this->middleware(['auth:api','role:admin']);
    }

    public function index()
    {
        $genres = Genre::all();
        return response()->json([
            'status' => true,
            'result' => new GenreCollection($genres)
        ]);
    }

    
    public function store(GenreRequest $request)
    {
        $genre = Genre::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Genre Added succesfully',
            'result' => new GenreResource($genre)
        ]);
    }

    
    public function show(Genre $genre)
    {
        return response()->json([
            'status' => true,
            'result' => new GenreResource($genre)
        ]);
    }

   
    
    public function update(UpadateGenreRequest $request, Genre $genre)
    {
        $genre->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Genre updated succesfully',
            'result' => new GenreResource($genre)
        ]);
    }

    
    public function destroy(Genre $genre)
    {
        $this->authorize('delete',$genre);
        
        $genre->delete();
        return response()->json([
            'status' => true,
            'message' => 'Genre deleted succesfully'
        ]);
    }
}
