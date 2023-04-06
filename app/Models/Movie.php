<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory , SoftDeletes;

    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'title',
        'tagline',
        'budget',
        'language',
        'overview',
        'release_date',
        'runtime',
        'rate',
        'status'
    ];

    public function genres(){
        return $this->belongsToMany(Genre::class);
    }
    public function productionCompanies(){
        return $this->belongsToMany(ProductionCompany::class);
    }
    public function showtimes(){
        return $this->hasMany(Showtime::class);
    }
    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }
    public function Users(){
        return $this->belongsToMany(User::class);
    }
}
