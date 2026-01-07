<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Resources\CategoryResource;
use Exception;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Home Page Data
     */
    public function index()
    {
        try {
            // HomePage.php fetches all categories directly
            $categories = Category::all();

            return ResponseHelper::success(message: 'Home data fetched successfully!', data: [
                'categories' => CategoryResource::collection($categories)
            ], statusCode: 200);

        } catch (Exception $e) {
            Log::error('Home Index Error: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch home data! Please try again!', statusCode: 500);
        }
    }
}
