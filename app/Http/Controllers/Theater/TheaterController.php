<?php

namespace App\Http\Controllers\Theater;

use App\Http\Controllers\Controller;
use App\Http\Requests\Theater\TheaterRequest;
use App\Http\Requests\Theater\UpdateTheaterRequest;
use App\Http\Resources\Theater\TheaterCollection;
use App\Http\Resources\Theater\TheaterResource;
use App\Models\Theater;
use Illuminate\Http\Request;

class TheaterController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','role:admin']);
    }
    public function index()
    {
        $theaters = Theater::with('schema','showtimes')->get();
        return response()->json([
            'status' => true,
            'result' => new TheaterCollection($theaters)
        ]);
    }

    
    public function store(TheaterRequest $request)
    {
        $theater = Theater::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Theater has been added succesfully',
            'result' => new TheaterResource(Theater::with('schema')->find($theater->id))
        ]);
    }

    
    
    public function show(Theater $theater)
    {
        return response()->json([
            'status' => true,
            'result' => new TheaterResource($theater->load('schema'))
        ]);
    }

    
    
    public function update(UpdateTheaterRequest $request, Theater $theater)
    {
        $this->authorize('update',$theater);
        
        $theater->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Theater details has been updated succesfully',
            'result' => new TheaterResource(Theater::with('schema')->find($theater->id))
        ]);
    }

    
    
    public function destroy(Theater $theater)
    {
        $this->authorize('delete',$theater);
        $theater->delete();
        return response()->json([
            'status' => true,
            'message' => 'Theater details has been delelted succesfully'
        ]);
    }
}
