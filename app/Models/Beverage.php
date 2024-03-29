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
        'price',
        'beverage_type_id'
    ];

    public function beverageType(){
        return $this->belongsTo(BeverageType::class);
    }
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
    public function tickets(){
        return $this->belongsToMany(Ticket::class);
    }
}
