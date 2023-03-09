<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'seats',
        'price'
    ];

    public function showtime(){
        $this->belongsTo(Showtime::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }
    public function beverages(){
        $this->belongsToMany(Beverage::class);
    }
}
