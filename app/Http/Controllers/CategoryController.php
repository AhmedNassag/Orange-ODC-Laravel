<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with('categories',$categories);
    }



    public function create()
    {
        return view('admin.categories.add');
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'category_name' => 'required|string|max:255',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category = Category::create
        ([
            'category_name' => $request->category_name,
        ]);
        if ($category)
        {
            return redirect('/categories')->with
            ([
                'message'    => 'Your Data Added Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/categories')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function edit(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        if(! $category)
        {
            return redirect()->back();
        }
        return view('admin.categories.edit')->with('category',$category);
    }



    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        if(! $category)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'category_name'     => 'required|string|max:255',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category->category_name = $request->category_name;
        $category->update();
        if ($category)
        {
            return redirect('/categories')->with
            ([
                'message'    => 'Your Data Updated Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/categories')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }



    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if ($category)
        {
            return redirect('/categories')->with
            ([
                'message'    => 'Your Data Deleted Successfully',
                'alert-type' => 'success'
            ]);
        }
        else
        {
            return redirect('/categories')->with
            ([
                'message'    => 'Something Was Wrong',
                'alert-type' => 'danger'
            ]);
        }
    }
}
