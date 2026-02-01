<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'rating' => (int) $this->rating,
            'comment' => $this->comment,
            'is_verified' => (bool) $this->is_verified,
            'created_at' => $this->created_at->diffForHumans(),
            'user' => [
                'name' => $this->user->first_name . ' ' . $this->user->last_name,
                'profile_photo' => \App\Helpers\ImageHelper::getUrl($this->user->profile_photo_path),
            ]
        ];
    }
}
