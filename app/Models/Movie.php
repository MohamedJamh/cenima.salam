<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id'
    ];

    public function showtimes(){
        $this->hasMany(Showtime::class);
    }
    public function images(){
        $this->morphMany(Image::class,'imageable');
    }
}
