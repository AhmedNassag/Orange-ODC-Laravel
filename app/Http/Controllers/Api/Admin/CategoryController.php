<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

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


    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'category_name'     => 'required|max:255',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $category = Category::create($request->all());
        if($category)
        {
            return $this->apiResponse($category,'The Category Save',201);
        }
        return $this->apiResponse(null,'The Category Not Save',400);
    }


    public function update(Request $request ,$id)
    {
        $validator  = Validator::make($request->all(),
        [
            'category_name'     => 'required|max:255',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $category = Category::find($id);
        if(!$category)
        {
            return $this->apiResponse(null,'The Category Not Found',404);
        }
        $category->update($request->all());
        if($category)
        {
            return $this->apiResponse($category,'The Category Update',201);
        }
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category)
        {
            return $this->apiResponse(null,'The Category Not Found',404);
        }
        $category->delete($id);
        if($category)
        {
            return $this->apiResponse(null,'The Category Deleted',200);
        }
    }
}
