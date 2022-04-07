<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Wrong;
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

    public function questionWrongs($id)
    {
        $wrongs = Wrong::get()->where('question_id',$id);
        if($wrongs)
        {
            return $this->apiResponse($wrongs,'Ok',200);
        }
        return $this->apiResponse(null,'The Wrong Not Found',404);
    }

    public function questionExam($id)
    {
        $question = Question::find($id);
        $exam     = Exam::find($question->exam_id);
        if($exam)
        {
            return $this->apiResponse($exam,'Ok',200);
        }
        return $this->apiResponse(null,'The Exam Not Found',404);
    }
}
