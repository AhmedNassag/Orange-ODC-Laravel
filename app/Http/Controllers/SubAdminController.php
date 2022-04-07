<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubAdmin;

class SubAdminController extends Controller
{
    public function login()
    {
        return view('auth.subAdminLogin');
    }


    public function checkSubAdmin(Request $request)
    {
        $this->validate($request,
        [
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);
        if(Auth::guard('subAdmin')->attempt(['email' => $request->email,'password' => $request->password]))
        {
            return redirect()->intended('/admins');
        }
        return redirect()->back()->withInput($request->only('email'));
    }


    public function index()
    {
        $subAdmins = SubAdmin::all();
        return view('admin.subAdmins.index')->with('subAdmins',$subAdmins);
    }



    public function create()
    {
        return view('admin.subAdmins.add');
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|max:255|email|unique:admins',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $subAdmin = SubAdmin::create
        ([
            'name'    => $request->name,
            'email'   => $request->email,
            'password'=> bcrypt($request->password),
            'image'   => $request->image,
        ]);
        if ($subAdmin)
        {
            return redirect('/subAdmins')->with
            ([
                'message'    => 'Your Data Added Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/subAdmins')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function edit(Request $request, $id)
    {
        $subAdmin = SubAdmin::findOrFail($id);
        if(! $subAdmin)
        {
            return redirect()->back();
        }
        return view('admin.subAdmins.edit')->with('subAdmin',$subAdmin);
    }



    public function update(Request $request, $id)
    {
        $subAdmin = SubAdmin::findOrFail($id);
        if(! $subAdmin)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|max:255|email',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $subAdmin->name     = $request->name;
        $subAdmin->email    = $request->email;
        $subAdmin->password = bcrypt($request->password);
        $subAdmin->image    = $request->image;
        $subAdmin->update();
        if ($subAdmin)
        {
            return redirect('/subAdmins')->with
            ([
                'message'    => 'Your Data Updated Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/subAdmins')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function delete($id)
    {
        $subAdmin = SubAdmin::findOrFail($id);
        $subAdmin->delete();
        if ($subAdmin)
        {
            return redirect('/subAdmins')->with
            ([
                'message'    => 'Your Data Deleted Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/admins')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }
}
