<?php

namespace App\Http\Resources\Movie;

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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'tagline' => $this->tagline,
            'budget' => $this->budget,
            'language' => $this->language,
            'overview' => $this->overview,
            'release_date' => $this->release_date,
            'runtime' => $this->runtime,
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
