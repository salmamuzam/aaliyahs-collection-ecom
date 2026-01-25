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
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            // Product count
            'products' => $this->when($this->relationLoaded('products'), $this->products->count())
        ];
    }
}
