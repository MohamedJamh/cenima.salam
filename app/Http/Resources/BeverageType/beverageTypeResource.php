<?php

namespace App\Http\Resources\BeverageType;

use App\Http\Resources\Beverage\BeverageCollection;
use App\Http\Resources\Beverage\BeverageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class beverageTypeResource extends JsonResource
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
            'beverage' => $this->whenLoaded('beverages', function () {
                return new BeverageCollection($this->beverages) ;
            })
        ];
    }
}
