<?php

namespace App\Http\Controllers\Showtime;

use App\Http\Controllers\Controller;
use App\Http\Requests\Showtime\StoreShowtimeRequest;
use App\Http\Requests\Showtime\UpdateShowtimeRequest;
use App\Http\Resources\Showtime\ShowtimeCollection;
use App\Http\Resources\Showtime\ShowtimeResource;
use App\Models\Movie;
use App\Models\Showtime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    
    public function index()
    {
        $showtimes = Showtime::with('movie','theater')
        ->where('date', '>=' , now()->toDateString())
        ->get();
        return response()->json([
            'status' => true,
            'result' => new ShowtimeCollection($showtimes)
        ]);
    }

    

    public function store(StoreShowtimeRequest $request)
    {
        
        $movie = Movie::find($request->input('movie_id'));
        $newStarts = Carbon::createFromTimeString($request->input('starts'));
        $newEnds = $newStarts->copy()->addMinutes($movie->runtime);

        $this->authorize('create',[
            Showtime::class,
            $request->input('date'),
            $request->input('theater_id'),
            $newStarts,
            $newEnds
        ]);

        $movie->update([
            'status' => 'premier'
        ]);
        $showtime = Showtime::create([
            'date' => $request->input('date'),
            'starts' => $newStarts->toTimeString(),
            'ends' => $newEnds->toTimeString(),
            'movie_id' => $request->input('movie_id'),
            'theater_id' => $request->input('theater_id'),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Showtime has been added successfuly',
            'result' => new ShowtimeResource($showtime->with('movie','theater')->first())
        ]);
    }

    

    public function show(Showtime $showtime)
    {
        return response()->json([
            'status' => true,
            'result' => new ShowtimeResource($showtime->load('movie','theater','tickets'))
        ]);
    }
    

    public function update(UpdateShowtimeRequest $request, Showtime $showtime)
    {
        $movieId = $request->has('movie_id') ? $request->input('movie_id') : $showtime->movie_id;
        $starts = $request->has('starts') ? $request->input('starts') : $showtime->starts;
        $movie = Movie::find($movieId);
        $newStarts = Carbon::createFromTimeString($starts);
        $newEnds = $newStarts->copy()->addMinutes($movie->runtime);

        $this->authorize('create',[
            Showtime::class,
            $request->has('date') ? $request->input('date') : $showtime->date ,
            $request->input('theater_id') ? $request->input('date') : $showtime->theater_id,
            $newStarts,
            $newEnds
        ]);
        $showtime->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Showtime has been updated successfuly',
            'result' => new ShowtimeResource($showtime)
        ]);
    }

    

    public function destroy(Showtime $showtime)
    {
        $showtime->delete();
        return response()->json([
            'status' => true,
            'message' => 'Showtime has been deleted successfuly'
        ]);

    }
}
