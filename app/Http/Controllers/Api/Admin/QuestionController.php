<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $questions = Question::get();
        return $this->apiResponse($questions,'Ok',200);
    }


    public function show($id)
    {
        $question = Question::find($id);
        if($question)
        {
            return $this->apiResponse($question,'Ok',200);
        }
        return $this->apiResponse(null,'The Question Not Found',404);
    }


    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'question_content' => 'required|string|max:255',
            'question_answer'  => 'required|string|max:255',
            'exam_id'          => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $question = Question::create($request->all());
        if($question)
        {
            return $this->apiResponse($question,'The Question Save',201);
        }
        return $this->apiResponse(null,'The Question Not Save',400);
    }


    public function update(Request $request ,$id)
    {
        $validator  = Validator::make($request->all(),
        [
            'question_content' => 'required|string|max:255',
            'question_answer'  => 'required|string|max:255',
            'exam_id'          => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $question = Question::find($id);
        if(!$question)
        {
            return $this->apiResponse(null,'The Question Not Found',404);
        }
        $question->update($request->all());
        if($question)
        {
            return $this->apiResponse($question,'The Question Update',201);
        }
    }


    public function destroy($id)
    {
        $question = Question::find($id);
        if(!$question)
        {
            return $this->apiResponse(null,'The Question Not Found',404);
        }
        $question->delete($id);
        if($question)
        {
            return $this->apiResponse(null,'The Question Deleted',200);
        }
    }
}
