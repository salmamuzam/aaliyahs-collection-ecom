<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'grand_total' => (float) $this->grand_total,
            'currency' => strtoupper($this->currency ?? 'LKR'),
            'status' => ucfirst($this->status), // New -> New
            'payment_status' => ucfirst($this->payment_status),
            'payment_method' => $this->payment_method,
            'shipping_amount' => (float) $this->shipping_amount,

            // Format Dates for Flutter Display
            'created_at' => $this->created_at->format('d-M-Y H:i'),
            'created_at_human' => $this->created_at->diffForHumans(),

            // Nested Relations (Conditional)
            'address' => $this->whenLoaded('address', function () {
                return [
                    'first_name' => $this->address->first_name,
                    'last_name' => $this->address->last_name,
                    'phone' => $this->address->phone,
                    'street' => $this->address->street_address,
                    'city' => $this->address->city,
                    'province' => $this->address->province,
                    'postal_code' => $this->address->postal_code,
                    'full_address' => "{$this->address->street_address}, {$this->address->city}, {$this->address->province}"
                ];
            }),

            'items' => $this->whenLoaded('items', function () {
                return $this->items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'name' => $item->product->name ?? 'Unknown Product', // Handle deleted products
                        'image' => $item->product->images[0] ?? null,
                        'quantity' => (int) $item->quantity,
                        'unit_amount' => (float) $item->unit_amount,
                        'total_amount' => (float) $item->total_amount,
                    ];
                });
            }),

            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->full_name,
                    'email' => $this->user->email
                ];
            })
        ];
    }
}
