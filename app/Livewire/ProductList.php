<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\withPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Storage;


class ProductList extends Component
{
    use withPagination, WithoutUrlPagination;

    public function render()
    {
        // Fetch the products
        // Show the last created product first
        $products = Product::orderBy('id', 'desc')->paginate(4);
        return view('livewire.product-list', compact('products'));
    }

    // Delete functionality
    public function deleteProduct(Product $product)
    {
        if ($product) {
            // if image exists in the storage, remove image from the storage
            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            // Delete product from the product table
            $deleteResponse = $product->delete();
            if ($deleteResponse) {
                session()->flash('success', 'Product deleted successfully!');
            } else {
                session()->flash('error', 'Unable to delete product, please try again!');
            }
        } else {
            session()->flash('error', 'Product not found, please try again!');
        }

        // prevent page reload
        return $this->redirect('/products', navigate: true);
    }
}
