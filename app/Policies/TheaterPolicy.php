<?php

namespace App\Policies;

use App\Models\Theater;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Exceptions\HttpResponseException;

class TheaterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     */
    public function view(User $user, Theater $theater)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     */
    public function update(User $user, Theater $theater)
    {
        if($theater->showtimes()->exists()){
            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'The theater is in use , Can\'t update details'
            ]));
        }
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     */
    public function delete(User $user, Theater $theater)
    {
        if($theater->showtimes()->exists()){
            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'The theater is in use , Can\'t delete theater'
            ]));
        }
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     */
    public function restore(User $user, Theater $theater)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     */
    public function forceDelete(User $user, Theater $theater)
    {
        //
    }
}
