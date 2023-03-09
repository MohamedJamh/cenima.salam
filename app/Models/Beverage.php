<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beverage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price'
    ];

    public function type(){
        $this->belongsTo(BeverageType::class);
    }
    public function image(){
        $this->morphOne(Image::class,'imageable');
    }
    public function tickets(){
        $this->belongsToMany(Ticket::class);
    }
}
