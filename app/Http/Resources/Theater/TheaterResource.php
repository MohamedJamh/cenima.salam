<?php

namespace App\Http\Resources\Theater;

use App\Http\Resources\Schema\SchemaCollection;
use App\Http\Resources\Schema\SchemaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TheaterResource extends JsonResource
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
            'name' => $this->name,
            'schema' => $this->whenLoaded('schema',function(){
                return new SchemaResource($this->schema);
            })

        ];
    }
}
