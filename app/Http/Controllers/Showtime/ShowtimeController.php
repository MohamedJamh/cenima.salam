<?php

namespace App\Http\Controllers\Showtime;

use App\Http\Controllers\Controller;
use App\Http\Requests\Showtime\StoreShowtimeRequest;
use App\Http\Resources\Showtime\ShowtimeCollection;
use App\Http\Resources\Showtime\ShowtimeResource;
use App\Models\Showtime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    
    public function index()
    {
        $showtimes = Showtime::with('movie','theater')->get();
        return response()->json([
            'status' => true,
            'result' => new ShowtimeCollection($showtimes)
        ]);
    }

    

    public function store(StoreShowtimeRequest $request)
    {
        $showtimeDate = $request->input('date');
        $showtimeTheaterId = $request->input('theater_id');

        
        $existingShowtime = Showtime::where('date',$showtimeDate)
        ->where('theater_id',$showtimeTheaterId)->first();
        
        if($existingShowtime){
            // there is a showtime in the same day and the same theater
            $oldStarts = Carbon::createFromTimeString($existingShowtime->starts)->subMinutes(9);
            $oldEnds = Carbon::createFromTimeString($existingShowtime->ends)->addMinutes(9);
            
            $newStarts = Carbon::createFromTimeString($request->input('starts'));
            $newEnds = Carbon::createFromTimeString($request->input('ends'));

            if($newStarts->between($oldStarts,$oldEnds) || $newEnds->between($oldStarts,$oldEnds)){
                return 'maymkench';
            }
        }
        return 'imken';

        // $showtime = Showtime::create($request->only([
        //     'date','starts','ends','movie_id','theater_id'
        // ]));
        // return response()->json([
        //     'status' => true,
        //     'message' => 'Showtime has been added successfuly',
        //     'result' => new ShowtimeResource($showtime)
        // ]);
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
