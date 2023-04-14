<?php

namespace App\Http\Resources\Beverage;

use Illuminate\Http\Resources\Json\JsonResource;

class BeverageResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'type' => $this->whenLoaded('beverageType', function () {
                return [
                    'id' => $this->beverageType->id,
                    'name' => $this->beverageType->name,
                ];
            }),
            'image' => $this->whenLoaded('image', function () {
                return [
                    'type' => $this->image->type,
                    'url' => $this->image->url,
                ];
            })
            
        ];
    }
}
