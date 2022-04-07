<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Course;


class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        return view('admin.exams.index')->with('exams',$exams);
    }



    public function create()
    {
        $courses = Course::all();
        return view('admin.exams.add')->with('courses',$courses);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'course_id'  => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $exam = Exam::create
        ([
            'course_id'  => $request->course_id,
        ]);
        if ($exam)
        {
            return redirect('/exams')->with
            ([
                'message'    => 'Your Data Added Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/exams')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function edit(Request $request, $id)
    {
        $exam     = Exam::findOrFail($id);
        $courses = Course::all();
        if(! $exam)
        {
            return redirect()->back();
        }
        return view('admin.exams.edit',compact(['exam','courses']));
    }



    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);
        if(! $exam)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'course_id'     => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $exam->course_id = $request->course_id;
        $exam->update();
        if ($exam)
        {
            return redirect('/exams')->with
            ([
                'message'    => 'Your Data Updated Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/exams')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function delete($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        if ($exam)
        {
            return redirect('/exams')->with
            ([
                'message'    => 'Your Data Deleted Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/exams')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }
}
