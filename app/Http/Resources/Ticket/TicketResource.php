<?php

namespace App\Http\Resources\Ticket;

use App\Http\Resources\Beverage\BeverageCollection;
use App\Http\Resources\Showtime\ShowtimeResource;
use Carbon\Carbon;
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
            'price' => $this->price + $this->whenLoaded('beverages',function(){
                return array_sum(array_column($this->beverages->toArray(),'price'));
            }),
            'user' => $this->whenLoaded('user',function(){
                return $this->user->name;
            }),
            'beverages' => $this->whenLoaded('beverages',function(){
                if(count($this->beverages)) return 'Yes';
                return 'No';
            }),
            'movie' => $this->whenLoaded('showtime',function(){
                return [
                    'title' => $this->showtime->movie->title,
                    'images' => $this->showtime->movie->images->last()->toArray()['url']
                ];
            }),
            'theater' => $this->whenLoaded('showtime',function(){
                return $this->showtime->theater->name;
            }),
            'showtime' => $this->whenLoaded('showtime',function(){
                return [
                    'date' => Carbon::createFromFormat('Y-m-d',$this->showtime->date)->format('D F Y'),
                    'starts' => Carbon::createFromTimeString($this->showtime->starts)->format('g:i A')
                ];
            }),
        ];
    }
}
