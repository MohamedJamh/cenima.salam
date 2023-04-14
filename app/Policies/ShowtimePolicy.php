<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\Showtime;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ShowtimePolicy
{
    use HandlesAuthorization;

    

    public function viewAny(User $user)
    {
        //
    }

    

    public function view(User $user, Showtime $showtime)
    {
        //
    }

    

    // public function create(User $user, Request $request , Carbon $newStarts , Carbon $newEnds)
    public function create(User $user, $date ,$theater_id, Carbon $newStarts , Carbon $newEnds)
    {

        $showtimeDate = $date;
        $showtimeTheaterId = $theater_id;

        $existingShowtimes = Showtime::where('date',$showtimeDate)
        ->where('theater_id',$showtimeTheaterId)
        ->orderBy('starts')
        ->get();
        
        if(count($existingShowtimes)){
            foreach ($existingShowtimes as $existingShowtime) {
                $oldStarts = Carbon::createFromTimeString($existingShowtime->starts)->subMinutes(9);
                $oldEnds = Carbon::createFromTimeString($existingShowtime->ends)->addMinutes(9);

                if($newEnds->lessThan($oldStarts) || $oldEnds->lessThan($newStarts)){
                    continue;
                }else{
                    throw new HttpResponseException(response()->json([
                        'status' => false,
                        'message' => 'Invalid Starting Time, Your movies ends at '
                        . $newEnds->toTimeString() .' , another movie is on '
                        . $oldStarts->toTimeString() . ' to ' . $oldEnds->toTimeString()
                        . ' (Cleaning Breaks included)'
                    ]));
                }
            }
        }
        return true;
    }

    

    public function update(User $user, Showtime $showtime)
    {
        return true;
    }

    

    public function delete(User $user, Showtime $showtime)
    {
        //
    }

    


    public function restore(User $user, Showtime $showtime)
    {
        //
    }

    

    public function forceDelete(User $user, Showtime $showtime)
    {
        //
    }
}
