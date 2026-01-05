<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => strtoupper($this->name),
            'price' => number_format($this->price, 2),
            'images' => $this->images,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
