<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

use Livewire\Attributes\Title;
use Livewire\Component;

class ProductDetailPage extends Component
{
    #[Title('Product Detail | Aaliyah Collection')]

    public $id;
    public $quantity = 1;

    public function mount($product)
    {

        $this->id = $product;

    }

    public function increaseQty()
    {
        $this->quantity++;
    }

    public function decreaseQty()
    {

        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    // add product to cart method

    public function addToCart($product_id)
    {
        // return total number of item count
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);
        // $this->dispatch('update-cart-count',  total_count: $total_count)->to(Navbar::class);
        LivewireAlert::title('Success!')
            ->text('Product added to the cart!')
            ->success()
            ->position('top-end')
            ->timer(3000)
            ->toast()
            ->show();
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
