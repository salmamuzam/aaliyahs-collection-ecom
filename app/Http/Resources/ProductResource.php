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
        $images = $this->images ?? [];

        // Convert relative paths to Cloudinary URLs
        $imageUrls = array_map(function ($path) {
            return \App\Helpers\ImageHelper::getUrl($path);
        }, $images);

        return [
            'id' => $this->id,
            'name' => strtoupper($this->name),
            'description' => $this->description,
            'price' => number_format($this->price, 2),
            'images' => $imageUrls,
            'total_sold' => $this->total_sold ?? 0,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
