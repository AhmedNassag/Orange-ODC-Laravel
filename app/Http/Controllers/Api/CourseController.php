<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $courses = Course::get();
        return $this->apiResponse($courses,'Ok',200);
    }


    public function show($id)
    {
        $course = Course::find($id);
        if($course)
        {
            return $this->apiResponse($course,'Ok',200);
        }
        return $this->apiResponse(null,'The Course Not Found',404);
    }


    public function courseByCategory($id)
    {
        $course = Course::get()->where('category_id',$id);
        if($course)
        {
            return $this->apiResponse($course,'Ok',200);
        }
        return $this->apiResponse(null,'The Course Not Found',404);
    }
}
