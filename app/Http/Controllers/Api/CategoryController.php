<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $categories = Category::get();
        return $this->apiResponse($categories,'Ok',200);
    }


    public function show($id)
    {
        $category = Category::find($id);
        if($category)
        {
            return $this->apiResponse($category,'Ok',200);
        }
        return $this->apiResponse(null,'The Category Not Found',404);
    }
}
