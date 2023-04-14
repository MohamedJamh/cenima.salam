<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'starts',
        'ends',
        'movie_id',
        'theater_id',
    ];

    public function theater(){
        return $this->belongsTo(Theater::class);
    }
    public function movie(){
        return $this->belongsTo(Movie::class);
    }
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
