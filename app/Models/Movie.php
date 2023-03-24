<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'status'
    ];

    public function showtimes(){
        return $this->hasMany(Showtime::class);
    }
    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }

    public function Users(){
        return $this->belongsToMany(User::class);
    }
}
