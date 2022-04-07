<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function login()
    {
        return view('auth.adminLogin');
    }


    public function checkAdmin(Request $request)
    {
        $this->validate($request,
        [
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);
        if(Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password]))
        {
            return redirect()->intended('/admins');
        }
        return redirect()->back()->withInput($request->only('email'));
    }



    public function index()
    {
        $admins = Admin::all();
        return view('admin.index')->with('admins',$admins);
    }



    public function create()
    {
        return view('admin.add');
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
        $admin = Admin::create
        ([
            'name'    => $request->name,
            'email'   => $request->email,
            'password'=> bcrypt($request->password),
            'image'   => $request->image,
        ]);
        if ($admin)
        {
            return redirect('/admins')->with
            ([
                'message'    => 'Your Data Added Successfully',
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



    public function edit(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        if(! $admin)
        {
            return redirect()->back();
        }
        return view('admin.edit')->with('admin',$admin);
    }



    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        if(! $admin)
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
        $admin->name     = $request->name;
        $admin->email    = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->image    = $request->image;
        $admin->update();
        if ($admin)
        {
            return redirect('/admins')->with
            ([
                'message'    => 'Your Data Updated Successfully',
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



    public function delete($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        if ($admin)
        {
            return redirect('/admins')->with
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
