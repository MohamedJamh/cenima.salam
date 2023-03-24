<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schema extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'layout_break',
        'capacity',
        'per_line'
    ];

    
    public function theaters(){
        return $this->hasMany(Theater::class);
    }
}
