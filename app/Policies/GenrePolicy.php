<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Exceptions\HttpResponseException;

class GenrePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Genre $genre)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Genre $genre)
    {
        //
    }

    public function delete(User $user, Genre $genre)
    {
        if($genre->movies()->exists()){
            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'This Genre has movies , Can\'t Delete Record '
            ]));
        }
        return true;
    }

    public function restore(User $user, Genre $genre)
    {
        
    }

    public function forceDelete(User $user, Genre $genre)
    {
        
    }
}
