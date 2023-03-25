<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "createdAt" => date_format($this->created_at, 'Y-m-d H:i:s')
        ];
        if(Auth::user()->hasRole('admin')){
            $roles = array();
            foreach ($this->roles as $role) {
                array_push($roles,$role->name);
            }
            $user['roles'] = $roles;
        }
        return $user;
    }
}
