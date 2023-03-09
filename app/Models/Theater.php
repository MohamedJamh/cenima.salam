<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'rows_num',
        'seats_num'
    ];

    public function showtimes(){
        $this->hasMany(Showtime::class);
    }
}
