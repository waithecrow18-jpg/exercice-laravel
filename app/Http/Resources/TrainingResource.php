<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->localize('title'),
            'slug' => $this->{'slug_'.app()->getLocale()},
            'short_description' => $this->localize('short_description'),
            'price' => $this->price,
            'price_formatted' => price_format($this->price),
            'duration_hours' => $this->duration_hours,
            'level' => $this->level,
            'category' => CategoryResource::make($this->whenLoaded('category')),
        ];
    }
}
