<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeverageType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function beverages(){
        return $this->hasMany(Beverage::class);
    }
}
