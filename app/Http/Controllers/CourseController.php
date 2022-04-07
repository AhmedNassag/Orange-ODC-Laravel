<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index')->with('courses',$courses);
    }



    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.add')->with('categories',$categories);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'course_name'  => 'required|string|max:255',
            'course_level' => 'required|string|max:255',
            'category_id'  => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $course = Course::create
        ([
            'course_name'  => $request->course_name,
            'course_level' => $request->course_level,
            'category_id'  => $request->category_id,
        ]);
        if ($course)
        {
            return redirect('/courses')->with
            ([
                'message'    => 'Your Data Added Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/courses')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function edit(Request $request, $id)
    {
        $course     = Course::findOrFail($id);
        $categories = Category::all();
        if(! $course)
        {
            return redirect()->back();
        }
        return view('admin.courses.edit',compact(['course','categories']));
    }



    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        if(! $course)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'course_name'     => 'required|string|max:255',
            'course_level'    => 'required|string|max:255',
            'category_id'     => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $course->course_name  = $request->course_name;
        $course->course_level = $request->course_level;
        $course->category_id    = $request->category_id;
        $course->update();
        if ($course)
        {
            return redirect('/courses')->with
            ([
                'message'    => 'Your Data Updated Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/courses')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function delete($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        if ($course)
        {
            return redirect('/courses')->with
            ([
                'message'    => 'Your Data Deleted Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/courses')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }
}
