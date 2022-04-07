<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Exam;


class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('admin.questions.index')->with('questions',$questions);
    }



    public function create()
    {
        $exams = Exam::all();
        return view('admin.questions.add')->with('exams',$exams);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'question_content'  => 'required|string|max:255',
            'question_answer'   => 'required|string|max:255',
            'exam_id'           => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $question = Question::create
        ([
            'question_content' => $request->question_content,
            'question_answer'  => $request->question_answer,
            'exam_id'          => $request->exam_id,
        ]);
        if ($question)
        {
            return redirect('/questions')->with
            ([
                'message'    => 'Your Data Added Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/questions')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function edit(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $exams    = Exam::all();
        if(! $question)
        {
            return redirect()->back();
        }
        return view('admin.questions.edit',compact(['question','exams']));
    }



    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        if(! $question)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'question_content'  => 'required|string|max:255',
            'question_answer'   => 'required|string|max:255',
            'exam_id'           => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $question->question_content = $request->question_content;
        $question->question_answer  = $request->question_answer;
        $question->exam_id          = $request->exam_id;
        $question->update();
        if ($question)
        {
            return redirect('/questions')->with
            ([
                'message'    => 'Your Data Updated Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/questions')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function delete($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        if ($question)
        {
            return redirect('/questions')->with
            ([
                'message'    => 'Your Data Deleted Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/questions')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }
}
