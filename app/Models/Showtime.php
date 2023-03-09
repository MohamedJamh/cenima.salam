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
        'ends'
    ];

    public function theater(){
        $this->belongsTo(Theater::class);
    }
    public function movie(){
        $this->belongsTo(Movie::class);
    }
    public function tickets(){
        $this->hasMany(Ticket::class);
    }
}
