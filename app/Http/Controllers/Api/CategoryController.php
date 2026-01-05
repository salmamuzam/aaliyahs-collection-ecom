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
            $query = Category::with('products');
            // search functionality
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            }
            $categories = $query->paginate(10);
            if ($categories) {
                return ResponseHelper::success(message: 'Categories fetched successfully!', data: CategoryResource::collection($categories), statusCode: 200);
            }
            return ResponseHelper::error(message: 'Unable to fetch categories! Please try again!', statusCode: 500);
        } catch (Exception $e) {
            Log::error('Unable to fetch categories: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch categories! Please try again!', statusCode: 500);
        }
    }
    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Store in REAL public/storage/categories folder
                $targetPath = public_path('storage/categories');
                $image->move($targetPath, $imageName);

                $data['image'] = 'categories/' . $imageName;
            }
            $category = Category::create($data);
            if ($category) {
                return ResponseHelper::success(message: 'Category has been created successfully!', data: new CategoryResource($category), statusCode: 201);
            }
            return ResponseHelper::error(message: 'Unable to create category! Please try again!', statusCode: 500);
        } catch (Exception $e) {
            Log::error('Unable to create category: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to create category! Please try again!', statusCode: 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try {
            return ResponseHelper::success(message: 'Category fetched successfully!', data: new CategoryResource($category), statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to fetch category: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch category! Please try again!', statusCode: 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Store in REAL public/storage/categories folder (No Symlinks)
                $targetPath = public_path('storage/categories');
                $image->move($targetPath, $imageName);

                // Save path as 'categories/image.jpg'
                $data['image'] = 'categories/' . $imageName;
            }
            $category->update($data);
            return ResponseHelper::success(message: 'Category has been updated successfully!', data: new CategoryResource($category), statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to update category: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to update category! Please try again!', statusCode: 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return ResponseHelper::success(message: 'Category has been deleted successfully!', statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to delete category: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to delete category! Please try again!', statusCode: 500);
        }
    }
}


