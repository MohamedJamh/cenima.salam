<?php

namespace App\Http\Resources\Movie;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $duration = Carbon::now()->addMinutes($this->runtime);
        $hours = $duration->diffInHours();
        $minutes = $duration->diffInMinutes() % 60;
        return [
            'id' => $this->id,
            'title' => $this->title,
            'tagline' => $this->tagline,
            'budget' => $this->budget,
            'language' => $this->language,
            'overview' => $this->overview,
            'release_date' => $this->release_date,
            'duration' => $this->runtime,
            'runtime' => $hours . ' hours ' . $minutes . ' minutes',
            'rate' => $this->rate,
            'status' => $this->status,
            'genres' => $this->genres->map(function ($genre) {
                return $genre->name;
            }),
            'production_companies' => $this->productionCompanies->map(function ($company) {
                return $company->name;
            }),
            'images' => $this->images->map(function ($image) {
                return [
                    'url' => $image->url,
                    'type' => $image->type
                ];
            }),
            'deleted_at' => $this->deleted_at
        ];
    }
}
