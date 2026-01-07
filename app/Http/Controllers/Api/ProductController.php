<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ProductRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $products = Product::with('category')
                ->when($request->search, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%")
                            ->orWhere('price', 'like', "%{$search}%")
                            ->orWhereHas('category', fn($q) => $q->where('name', 'like', "%{$search}%"));
                    });
                })
                ->when($request->category_name, function ($query, $categoryName) {
                    $query->whereHas('category', fn($q) => $q->where('name', $categoryName));
                })
                ->paginate(10);

            return ResponseHelper::success(
                message: 'Products fetched successfully!',
                data: ProductResource::collection($products)
            );
        } catch (Exception $e) {
            Log::error('Unable to fetch products: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to fetch products!', statusCode: 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            $data = $request->validated();
            $data = $this->resolveCategory($data);
            $data['images'] = $this->processNewImages($request);

            $product = Product::create($data);
            $product->load('category');

            return ResponseHelper::success(message: 'Product created successfully!', data: new ProductResource($product), statusCode: 201);
        } catch (Exception $e) {
            Log::error('Unable to create product: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to create product!', statusCode: 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try {
            $product->load('category');
            return ResponseHelper::success(message: 'Product fetched successfully!', data: new ProductResource($product));
        } catch (Exception $e) {
            Log::error('Unable to fetch product: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to fetch product!', statusCode: 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $data = $request->validated();
            $data = $this->resolveCategory($data);

            if ($request->hasFile('images')) {
                $data['images'] = $this->processImageUpdates($request, $product->images);
            }

            $product->update($data);
            $product->load('category');

            return ResponseHelper::success(message: 'Product has been updated successfully!', data: new ProductResource($product));
        } catch (Exception $e) {
            Log::error('Unable to update product: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to update product!', statusCode: 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return ResponseHelper::success(message: 'Product has been deleted successfully!');
        } catch (Exception $e) {
            Log::error('Unable to delete product: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to delete product!', statusCode: 500);
        }
    }

    /**
     * Extension: Fetch related products
     */
    public function related(Product $product)
    {
        try {
            $relatedProducts = Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->inRandomOrder()
                ->limit(4)
                ->get();

            return ResponseHelper::success(
                message: 'Related products fetched!',
                data: ProductResource::collection($relatedProducts)
            );
        } catch (Exception $e) {
            Log::error('Unable to fetch related products: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Error fetching related products', statusCode: 500);
        }
    }

    // --- Helper Methods ---

    private function resolveCategory(array $data): array
    {
        if (isset($data['category_name'])) {
            $category = \App\Models\Category::where('name', $data['category_name'])->first();
            $data['category_id'] = $category->id ?? null; // Handle potential null if category not found?
            unset($data['category_name']);
        }
        return $data;
    }

    private function processNewImages(ProductRequest $request): array
    {
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePaths[] = $image->storeAs('uploads/products', $imageName, 'public');
            }
        }
        return $imagePaths;
    }

    private function processImageUpdates(ProductRequest $request, ?array $currentImages): array
    {
        $updatedImages = $currentImages ?? [];
        foreach ($request->file('images') as $index => $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Replace or add image at specific index
            $updatedImages[$index] = $image->storeAs('uploads/products', $imageName, 'public');
        }
        return $updatedImages;
    }
}
