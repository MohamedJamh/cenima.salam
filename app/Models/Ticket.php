<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'seats',
        'price',
        'user_id',
        'showtime_id'
    ];

    public function showtime(){
        return $this->belongsTo(Showtime::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function beverages(){
        return $this->belongsToMany(Beverage::class);
    }
}
