<?php

namespace App\Http\Resources\Ticket;

use App\Http\Resources\Beverage\BeverageCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'seats' => $this->seats,
            'price' => $this->price,
            'user' => $this->whenLoaded('user',function(){
                return $this->user->name;
            }),
            'beverages' => $this->whenLoaded('beverages',function(){
                return [
                    'number' => count($this->beverages),
                    'beverage_totale' => array_sum(array_column($this->beverages->toArray(),'price'))
                ];
            })
        ];
    }
}
