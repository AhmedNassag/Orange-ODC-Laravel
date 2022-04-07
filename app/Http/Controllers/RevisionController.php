<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Revision;
use App\Models\User;
use App\Models\Exam;

class RevisionController extends Controller
{
    public function index()
    {
        $revisions = Revision::all();
        return view('admin.revisions.index')->with('revisions',$revisions);
    }



    public function create()
    {
        $users = User::all();
        $exams = Exam::all();
        return view('admin.revisions.add',compact(['users','exams']));
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'user_degree'        => 'required',
            'total_right_degree' => 'required',
            'total_wrong_degree' => 'required',
            'exam_id'           => 'required',
            'user_id'           => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $revision = Revision::create
        ([
            'user_degree'        => $request->user_degree,
            'total_right_degree' => $request->total_right_degree,
            'total_wrong_degree' => $request->total_wrong_degree,
            'exam_id'            => $request->exam_id,
            'user_id'            => $request->user_id,
        ]);
        if ($revision)
        {
            return redirect('/revisions')->with
            ([
                'message'    => 'Your Data Added Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/revisions')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function edit(Request $request, $id)
    {
        $revision = Revision::findOrFail($id);
        $exams    = Exam::all();
        $users = User::all();
        if(! $revision)
        {
            return redirect()->back();
        }
        return view('admin.revisions.edit',compact(['revision','exams','users']));
    }



    public function update(Request $request, $id)
    {
        $revision = Revision::findOrFail($id);
        if(! $revision)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'user_degree'        => 'required',
            'total_right_degree' => 'required',
            'total_wrong_degree' => 'required',
            'exam_id'           => 'required',
            'user_id'           => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $revision->user_degree        = $request->user_degree;
        $revision->total_right_degree = $request->total_right_degree;
        $revision->total_wrong_degree = $request->total_wrong_degree;
        $revision->exam_id            = $request->exam_id;
        $revision->user_id            = $request->user_id;
        $revision->update();
        if ($revision)
        {
            return redirect('/revisions')->with
            ([
                'message'    => 'Your Data Updated Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/revisions')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function delete($id)
    {
        $revision = Revision::findOrFail($id);
        $revision->delete();
        if ($revision)
        {
            return redirect('/revisions')->with
            ([
                'message'    => 'Your Data Deleted Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/revisions')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }
}
