<?php

namespace App\Livewire\Admin;

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

    // by default sort by id
    public $sortColumn = 'id';

    public $sortOrder = 'asc';

    public function sortBy($columnName)
    {
        if ($this->sortColumn === $columnName) {
            // Assign sort order
            // check current sort order
            $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $columnName;
            $this->sortOrder = 'asc';
        }
    }

    public function fetchProducts()
    {
        // Check if we need to join for sorting
        $needsJoin = $this->sortColumn === 'category.name';

        $query = Product::with('category');

        // Add join first if needed
        if ($needsJoin) {
            $query->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*');
        }

        // Then add search conditions with appropriate prefixes
        $query->where(function ($q) use ($needsJoin) {
            $prefix = $needsJoin ? 'products.' : '';
            $q->where($prefix . 'name', 'like', '%' . $this->search . '%')
                ->orWhere($prefix . 'description', 'like', '%' . $this->search . '%')
                ->orWhere($prefix . 'category_id', 'like', '%' . $this->search . '%')
                ->orWhere($prefix . 'price', 'like', '%' . $this->search . '%');
        });

        // Handle sorting
        if ($needsJoin) {
            $query->orderBy('categories.name', $this->sortOrder);
        } else {
            $query->orderBy($this->sortColumn, $this->sortOrder);
        }

        return $query->paginate(4);
    }

    public function render()
    {

        $products = $this->fetchProducts();
        return view('livewire.admin.product-list', compact('products'));

    }

    // Delete functionality
    public function deleteProduct(Product $product)
    {
        if ($product) {
            // if images exist in the storage, remove them from the storage
            if (!empty($product->images)) {
                foreach ($product->images as $image) {
                    if (Storage::exists($image)) {
                        Storage::delete($image);
                    }
                }
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
