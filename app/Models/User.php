<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable Implements JWTSubject,CanResetPassword,MustVerifyEmail
{
    use HasFactory, Notifiable , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
    public function movies(){
        return $this->belongsToMany(Movie::class);
    }
}
