<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\CategoryRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $search = $request->search;
            $page = $request->input('page', 1);
            $cacheKey = 'categories_' . ($search ? 'search_' . md5($search) : 'all') . '_page_' . $page;

            $categories = cache()->remember($cacheKey, 3600, function () use ($search) {
                return Category::with('products')
                    ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
                    ->paginate(10);
            });

            return ResponseHelper::success(
                message: 'Categories fetched successfully!',
                data: CategoryResource::collection($categories)
            );
        } catch (Exception $e) {
            Log::error('Unable to fetch categories: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to fetch categories!', statusCode: 500);
        }
    }

    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['image'] = $this->handleImageUpload($request);

            $category = Category::create($data);

            // Consistency: Clear related caches
            cache()->forget('api_home_categories');
            cache()->flush(); // Clear paginated category lists

            return ResponseHelper::success(message: 'Category has been created successfully!', data: new CategoryResource($category), statusCode: 201);
        } catch (Exception $e) {
            Log::error('Unable to create category: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to create category!', statusCode: 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try {
            return ResponseHelper::success(message: 'Category fetched successfully!', data: new CategoryResource($category));
        } catch (Exception $e) {
            Log::error('Unable to fetch category: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to fetch category!', statusCode: 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $data = $request->validated();

            if ($path = $this->handleImageUpload($request)) {
                $data['image'] = $path;
            }

            $category->update($data);

            // Consistency: Clear related caches
            cache()->forget('api_home_categories');
            cache()->flush(); // Clear paginated category lists

            return ResponseHelper::success(message: 'Category has been updated successfully!', data: new CategoryResource($category));
        } catch (Exception $e) {
            Log::error('Unable to update category: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to update category!', statusCode: 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            // Consistency: Clear related caches
            cache()->forget('api_home_categories');
            cache()->flush();

            return ResponseHelper::success(message: 'Category has been deleted successfully!');
        } catch (Exception $e) {
            Log::error('Unable to delete category: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to delete category!', statusCode: 500);
        }
    }

    // --- Helper Methods ---

    private function handleImageUpload(Request $request): ?string
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            return $image->storeAs('uploads/categories', $imageName, 'public');
        }
        return null;
    }
}


