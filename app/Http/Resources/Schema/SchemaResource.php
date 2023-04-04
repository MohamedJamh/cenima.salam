<?php

namespace App\Http\Resources\Schema;

use App\Http\Resources\Theater\TheaterCollection;
use App\Http\Resources\Theater\TheaterResource;
use App\Models\Theater;
use Illuminate\Http\Resources\Json\JsonResource;

class SchemaResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "capacity" => $this->capacity,
            "per_line" => $this->per_line,
            "layout_break" => $this->layout_break,
            "theaters" => $this->whenLoaded('theaters',function(){
                return new TheaterCollection($this->theaters);
            })
        ];
    }
}
