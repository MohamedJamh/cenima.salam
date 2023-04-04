<?php

namespace App\Http\Controllers\Theater;

use App\Http\Controllers\Controller;
use App\Http\Requests\Theater\TheaterRequest;
use App\Http\Resources\Theater\TheaterCollection;
use App\Http\Resources\Theater\TheaterResource;
use App\Models\Theater;
use Illuminate\Http\Request;

class TheaterController extends Controller
{
    public function index()
    {
        $theaters = Theater::with('schema')->get();
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
            'message' => 'Theater has been added succesfully',
            'result' => new TheaterResource(Theater::with('schema')->find($theater->id))
        ]);
    }

    
    
    public function update(TheaterRequest $request, Theater $theater)
    {
        return response()->json([
            'status' => true,

        ]);
    }

    
    
    public function destroy($id)
    {
        //
    }
}
