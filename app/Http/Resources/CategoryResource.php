<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => strtoupper($this->name),
            'image' => \App\Helpers\ImageHelper::getUrl($this->image),
            // Product count - Safer check to avoid strict mode errors
            'products_count' => $this->when(isset($this->resource->getAttributes()['products_count']), fn() => (int) $this->products_count),
            'items_count' => $this->when($this->relationLoaded('products'), fn() => $this->products->count())
        ];
    }
}
