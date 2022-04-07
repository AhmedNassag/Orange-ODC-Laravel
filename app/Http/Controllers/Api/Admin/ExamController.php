<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $exams = Exam::get();
        return $this->apiResponse($exams,'Ok',200);
    }


    public function show($id)
    {
        $exam = Exam::find($id);
        if($exam)
        {
            return $this->apiResponse($exam,'Ok',200);
        }
        return $this->apiResponse(null,'The Exam Not Found',404);
    }


    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'course_id'  => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $exam = Exam::create($request->all());
        if($exam)
        {
            return $this->apiResponse($exam,'The Exam Save',201);
        }
        return $this->apiResponse(null,'The Exam Not Save',400);
    }


    public function update(Request $request ,$id)
    {
        $validator  = Validator::make($request->all(),
        [
            'course_id'  => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $exam = Exam::find($id);
        if(!$exam)
        {
            return $this->apiResponse(null,'The Exam Not Found',404);
        }
        $exam->update($request->all());
        if($exam)
        {
            return $this->apiResponse($exam,'The Exam Update',201);
        }
    }


    public function destroy($id)
    {
        $exam = Exam::find($id);
        if(!$exam)
        {
            return $this->apiResponse(null,'The Exam Not Found',404);
        }
        $exam->delete($id);
        if($exam)
        {
            return $this->apiResponse(null,'The Exam Deleted',200);
        }
    }
}
