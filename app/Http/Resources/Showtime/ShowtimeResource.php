<?php

namespace App\Http\Resources\Showtime;

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
            'date' => $this->date,
            'starts' => $this->starts,
            'ends' => $this->ends,
            'movie' => $this->whenLoaded('movie',function(){
                return [
                    'movie_id' => $this->movie->id,
                    'title' => $this->movie->title,
                ];
            }),
            'theater' => $this->whenLoaded('theater',function(){
                return [
                    'theater_id' => $this->theater->id,
                    'name' => $this->theater->name,
                ];
            }),
        ];
    }
}
