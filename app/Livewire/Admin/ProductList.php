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

    public function placeholder()
    {
        return view('livewire.placeholders.product-list-skeleton');
    }

    public function render()
    {
        $needsJoin = $this->sortColumn === 'category.name';

        $products = Product::with('category')
            ->when($needsJoin, fn($q) => $q->join('categories', 'products.category_id', '=', 'categories.id')->select('products.*'))
            ->when($this->search, function ($query, $search) use ($needsJoin) {
                $prefix = $needsJoin ? 'products.' : '';
                $query->where(function ($q) use ($search, $prefix) {
                    $q->where($prefix . 'name', 'like', "%{$search}%")
                        ->orWhere($prefix . 'description', 'like', "%{$search}%")
                        ->orWhere($prefix . 'price', 'like', "%{$search}%");
                });
            })
            ->when($needsJoin, fn($q) => $q->orderBy('categories.name', $this->sortOrder), fn($q) => $q->orderBy($this->sortColumn, $this->sortOrder))
            ->paginate(4);

        return view('livewire.admin.product-list', compact('products'));
    }

    public function deleteProduct(Product $product)
    {
        // Terse file deletion
        collect($product->images ?? [])->each(fn($img) => Storage::delete($img));

        $status = $product->delete();
        session()->flash($status ? 'success' : 'error', $status ? 'Product deleted!' : 'Deletion failed.');

        // Adjust pagination fluently
        $this->gotoPage(Product::count() <= ($this->activePageNumber - 1) * 4 ? max(1, $this->activePageNumber - 1) : $this->activePageNumber);
    }

    public function updatingPage($pageNumber)
    {
        $this->activePageNumber = $pageNumber;
    }
}
