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
            'movieId' => $this->movie_id,
            'theaterId' => $this->theater_id
        ];
    }
}
