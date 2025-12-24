<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductDetailPage extends Component
{
    #[Title('Product Detail | Aaliyah Collection')]

    public $id;


    public function mount($product)
    {

        $this->id = $product;

    }
    public function render()
    {
        return view(
            'livewire.product-detail-page',
            [
                'product' => Product::where('id', $this->id)->firstOrFail()
            ]
        );
    }
}
