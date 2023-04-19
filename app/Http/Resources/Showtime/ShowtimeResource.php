<?php

namespace App\Http\Resources\Showtime;

use App\Http\Resources\Genre\GenreCollection;
use App\Http\Resources\Movie\MovieCollection;
use App\Http\Resources\Movie\MovieResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowtimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        return [
            'id' => $this->id,
            'date' => Carbon::createFromFormat('Y-m-d',$this->date)->format('D F Y'),
            'starts' => Carbon::createFromTimeString($this->starts)->format('g:i A'),
            'ends' => Carbon::createFromTimeString($this->ends)->format('g:i A'),
            'movie' => $this->whenLoaded('movie',function(){
                return new MovieResource($this->movie);
            }),
            'theater' => $this->whenLoaded('theater',function(){
                return [
                    'theater_id' => $this->theater->id,
                    'name' => $this->theater->name,
                ];
            }),
            'tickets' => $this->whenLoaded('tickets',function(){
                return array_column($this->tickets->toArray(),'seats') ;
            }),
            'dateString' => $this->date,
            'startsString' => $this->starts,
        ];
    }
}
