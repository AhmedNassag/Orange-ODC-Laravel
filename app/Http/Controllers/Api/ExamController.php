<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Revision;

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


    public function examCourse($id)
    {
        $exam = Exam::get()->where('course_id',$id);
        $course = Course::find($exam);
        if($course)
        {
            return $this->apiResponse($course,'Ok',200);
        }
        return $this->apiResponse(null,'The Course Not Found',404);
    }


    public function examQuestions($id)
    {
        $questions = Question::get()->where('exam_id',$id);;
        if($questions)
        {
            return $this->apiResponse($questions,'Ok',200);
        }
        return $this->apiResponse(null,'The Question Not Found',404);
    }


    public function examRevisions($id)
    {
        $revisions = Revision::get()->where('exam_id',$id);
        if($revisions)
        {
            return $this->apiResponse($revisions,'Ok',200);
        }
        return $this->apiResponse(null,'The Revision Not Found',404);
    }
}
