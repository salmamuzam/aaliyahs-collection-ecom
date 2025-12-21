<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\withPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;



class ProductList extends Component
{
    use withPagination, WithoutUrlPagination;

    #[Title('Admin Dashboard | Products')]

    public $search = null;

    public function render()
    {
        // Fetch the products
        // Show the last created product first
        // If search matches, it will filter out
        // Search by name
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            // or description
            ->orWhere('description', 'like', '%' . $this->search . '%')
            // or category
            ->orWhere('category_id', 'like', '%' . $this->search . '%')
            // or price
            ->orWhere('price', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(4);

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
