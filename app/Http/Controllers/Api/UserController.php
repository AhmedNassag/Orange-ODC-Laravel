<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Revision;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $users = User::get();
        return $this->apiResponse($users,'Ok',200);
    }


    public function show($id)
    {
        $user = User::find($id);
        if($user)
        {
            return $this->apiResponse($user,'Ok',200);
        }
        return $this->apiResponse(null,'The User Not Found',404);
    }


    public function userRevisions($id)
    {
        $revisions = Revision::get()->where('user_id',$id);
        if($revisions)
        {
            return $this->apiResponse($revisions,'Ok',200);
        }
        return $this->apiResponse(null,'The Course Not Found',404);
    }


    public function successStudents()
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
