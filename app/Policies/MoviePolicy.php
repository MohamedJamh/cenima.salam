<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Exceptions\HttpResponseException;

class MoviePolicy
{
    use HandlesAuthorization;

    
    
    public function viewAny(User $user)
    {
        //
    }

   
    
    public function view(User $user, Movie $movie)
    {
        //
    }

   
    
    public function create(User $user)
    {
        //
    }

    
    
    public function update(User $user, Movie $movie)
    {
        if($movie->showtimes()->exists()){
            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'Movie has showtimes at the moment'
            ]));
        }
        return true;
    }

    
    
    public function delete(User $user, Movie $movie)
    {
        if($movie->showtimes()->exists()){
            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'Movie has showtimes at the moment'
            ]));
        }
        return true;
    }

    
    public function restore(User $user, Movie $movie)
    {

    }

    
    
    public function forceDelete(User $user, Movie $movie)
    {
        //
    }
}
