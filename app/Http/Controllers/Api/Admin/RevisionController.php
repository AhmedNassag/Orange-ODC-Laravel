<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Revision;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $revisions = Revision::get();
        return $this->apiResponse($revisions,'Ok',200);
    }


    public function show($id)
    {
        $revision = Revision::find($id);
        if($revision)
        {
            return $this->apiResponse($revision,'Ok',200);
        }
        return $this->apiResponse(null,'The Revision Not Found',404);
    }


    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'user_degree'        => 'required|numeric',
            'total_right_degree' => 'required|numeric',
            'total_wrong_degree' => 'required|numeric',
            'exam_id'            => 'required|numeric',
            'user_id'            => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $revision = Revision::create($request->all());
        if($revision)
        {
            return $this->apiResponse($revision,'The Revision Save',201);
        }
        return $this->apiResponse(null,'The Revision Not Save',400);
    }


    public function update(Request $request ,$id)
    {
        $validator  = Validator::make($request->all(),
        [
            'user_degree'        => 'required|numeric',
            'total_right_degree' => 'required|numeric',
            'total_wrong_degree' => 'required|numeric',
            'exam_id'            => 'required|numeric',
            'user_id'            => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $revision = Revision::find($id);
        if(!$revision)
        {
            return $this->apiResponse(null,'The Revision Not Found',404);
        }
        $revision->update($request->all());
        if($revision)
        {
            return $this->apiResponse($revision,'The Revision Update',201);
        }
    }


    public function destroy($id)
    {
        $revision = Revision::find($id);
        if(!$revision)
        {
            return $this->apiResponse(null,'The Revision Not Found',404);
        }
        $revision->delete($id);
        if($revision)
        {
            return $this->apiResponse(null,'The Revision Deleted',200);
        }
    }


    public function successStudent()
    {
        $successStudents = Revision::get()->where('user_degree','>=',50);
        if($successStudents)
        {
            return $this->apiResponse($successStudents,'Ok',200);
        }
        return $this->apiResponse(null,'The Success Students Not Found',404);
    }


    public function failingStudents()
    {
        $faildStudent = Revision::get()->where('user_degree','<',50);
        if($faildStudent)
        {
            return $this->apiResponse($faildStudent,'Ok',200);
        }
        return $this->apiResponse(null,'The Success Students Not Found',404);
    }
}
