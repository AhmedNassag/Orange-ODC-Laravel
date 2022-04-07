<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Wrong;
use Illuminate\Http\Request;

class WrongController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $wrongs = Wrong::get();
        return $this->apiResponse($wrongs,'Ok',200);
    }


    public function show($id)
    {
        $wrong = Wrong::find($id);
        if($wrong)
        {
            return $this->apiResponse($wrong,'Ok',200);
        }
        return $this->apiResponse(null,'The Wrong Not Found',404);
    }


    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'wrong_content' => 'required|max:255',
            'question_id'  => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $wrong = Wrong::create($request->all());
        if($wrong)
        {
            return $this->apiResponse($wrong,'The Wrong Save',201);
        }
        return $this->apiResponse(null,'The Wrong Not Save',400);
    }


    public function update(Request $request ,$id)
    {
        $validator  = Validator::make($request->all(),
        [
            'wrong_content' => 'required|max:255',
            'question_id'  => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $wrong = Wrong::find($id);
        if(!$wrong)
        {
            return $this->apiResponse(null,'The Wrong Not Found',404);
        }
        $wrong->update($request->all());
        if($wrong)
        {
            return $this->apiResponse($wrong,'The Wrong Update',201);
        }
    }


    public function destroy($id)
    {
        $wrong = Wrong::find($id);
        if(!$wrong)
        {
            return $this->apiResponse(null,'The Wrong Not Found',404);
        }
        $wrong->delete($id);
        if($wrong)
        {
            return $this->apiResponse(null,'The Wrong Deleted',200);
        }
    }
}
