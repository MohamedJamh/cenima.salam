<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'schema_id'
    ];

    public function showtimes(){
        return $this->hasMany(Showtime::class);
    }
    public function schema(){
        return $this->belongsTo(Schema::class);
    }
}
