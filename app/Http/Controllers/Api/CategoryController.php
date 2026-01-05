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
    public function index()
    {
        try {
            //Relationship with products
            $categories = Category::with('products')->get();
            if ($categories) {
                return ResponseHelper::success(message: 'Categories fetched successfully!', data: CategoryResource::collection($categories), statusCode: 200);
            }
            return ResponseHelper::error(message: 'Unable to fetch categories! Please try again!', statusCode: 500);
        } catch (Exception $e) {
            Log::error('Unable to fetch categories: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch categories! Please try again!', statusCode: 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/categories'), $imageName);
                $data['image'] = 'uploads/categories/' . $imageName;
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
            if ($category) {
                return ResponseHelper::success(message: 'Category fetched successfully!', data: new CategoryResource($category), statusCode: 200);
            }
            return ResponseHelper::error(message: 'Category not found!', statusCode: 404);
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
                $image->move(public_path('uploads/categories'), $imageName);
                $data['image'] = 'uploads/categories/' . $imageName;
            }
            $category->update($data);
            if ($category) {
                return ResponseHelper::success(message: 'Category has been updated successfully!', data: new CategoryResource($category), statusCode: 200);
            }
            return ResponseHelper::error(message: 'Unable to update category! Please try again!', statusCode: 500);
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


