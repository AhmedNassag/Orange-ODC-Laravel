<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

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


    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'course_name'  => 'required|max:255',
            'course_level' => 'required|max:255',
            'category_id'  => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $course = Course::create($request->all());
        if($course)
        {
            return $this->apiResponse($course,'The Course Save',201);
        }
        return $this->apiResponse(null,'The Course Not Save',400);
    }


    public function update(Request $request ,$id)
    {
        $validator  = Validator::make($request->all(),
        [
            'course_name'  => 'required|max:255',
            'course_level' => 'required|max:255',
            'category_id'  => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $course = Course::find($id);
        if(!$course)
        {
            return $this->apiResponse(null,'The Course Not Found',404);
        }
        $course->update($request->all());
        if($course)
        {
            return $this->apiResponse($course,'The Course Update',201);
        }
    }


    public function destroy($id)
    {
        $course = Course::find($id);
        if(!$course)
        {
            return $this->apiResponse(null,'The Course Not Found',404);
        }
        $course->delete($id);
        if($course)
        {
            return $this->apiResponse(null,'The Course Deleted',200);
        }
    }
}
