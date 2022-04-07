<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainer;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = Trainer::all();
        return view('admin.trainers.index')->with('trainers',$trainers);
    }



    public function create()
    {
        return view('admin.trainers.add');
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'trainer_name' => 'required|string|max:255',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $trainer = Trainer::create
        ([
            'trainer_name' => $request->trainer_name,
        ]);
        if ($trainer)
        {
            return redirect('/trainers')->with
            ([
                'message'    => 'Your Data Added Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/trainers')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function edit(Request $request, $id)
    {
        $trainer = Trainer::findOrFail($id);
        if(! $trainer)
        {
            return redirect()->back();
        }
        return view('admin.trainers.edit')->with('trainer',$trainer);
    }



    public function update(Request $request, $id)
    {
        $trainer = Trainer::findOrFail($id);
        if(! $trainer)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'trainer_name'     => 'required|string|max:255',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $trainer->trainer_name = $request->trainer_name;
        $trainer->update();
        if ($trainer)
        {
            return redirect('/trainers')->with
            ([
                'message'    => 'Your Data Updated Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/trainer')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function delete($id)
    {
        $trainer = Trainer::findOrFail($id);
        $trainer->delete();
        if ($trainer)
        {
            return redirect('/trainers')->with
            ([
                'message'    => 'Your Data Deleted Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/trainers')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }
}
