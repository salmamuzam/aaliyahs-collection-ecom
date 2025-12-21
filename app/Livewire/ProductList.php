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
    public $activePageNumber = 1;

    public function fetchProducts()
    {
        // Fetch the products
        // Show the last created product first
        // If search matches, it will filter out
        // Search by name
        return Product::where('name', 'like', '%' . $this->search . '%')
            // or description
            ->orWhere('description', 'like', '%' . $this->search . '%')
            // or category
            ->orWhere('category_id', 'like', '%' . $this->search . '%')
            // or price
            ->orWhere('price', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(4);
    }

    public function render()
    {

        $products = $this->fetchProducts();
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

        $products = $this->fetchProducts();
        // check the count of the products and active page number
        if ($products->isEmpty() && $this->activePageNumber > 1) {
            // redirect to the previous page
            $this->gotoPage($this->activePageNumber - 1);
        } else {
            // redirect to the same page
            $this->gotoPage($this->activePageNumber);
        }

        // redirect to the product listing page

        // prevent page reload
        // return $this->redirect('/products', navigate: true);
    }

    // Tracks the active page from pagination
    public function updatingPage($pageNumber)
    {
        $this->activePageNumber = $pageNumber;
    }
}
