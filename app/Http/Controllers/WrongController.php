<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Wrong;

class WrongController extends Controller
{
    public function index()
    {
        $wrongs = Wrong::all();
        return view('admin.wrongs.index')->with('wrongs',$wrongs);
    }



    public function create()
    {
        $questions = Question::all();
        return view('admin.wrongs.add')->with('questions',$questions);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'wrong_content' => 'required|max:255',
            'question_id'    => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $wrong = Wrong::create
        ([
            'wrong_content' => $request->wrong_content,
            'question_id'   => $request->question_id,
        ]);
        if ($wrong)
        {
            return redirect('/wrongs')->with
            ([
                'message'    => 'Your Data Added Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/wrongs')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function edit(Request $request, $id)
    {
        $wrong     = Wrong::findOrFail($id);
        $questions = Question::all();
        if(! $wrong)
        {
            return redirect()->back();
        }
        return view('admin.wrongs.edit',compact(['wrong','questions']));
    }



    public function update(Request $request, $id)
    {
        $wrong = Wrong::findOrFail($id);
        if(! $wrong)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'wrong_content' => 'required|max:255',
            'question_id'   => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $wrong->wrong_content = $request->wrong_content;
        $wrong->question_id   = $request->question_id;
        $wrong->update();
        if ($wrong)
        {
            return redirect('/wrongs')->with
            ([
                'message'    => 'Your Data Updated Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/wrongs')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function delete($id)
    {
        $wrong = Wrong::findOrFail($id);
        $wrong->delete();
        if ($wrong)
        {
            return redirect('/wrongs')->with
            ([
                'message'    => 'Your Data Deleted Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/wrongs')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }
}
