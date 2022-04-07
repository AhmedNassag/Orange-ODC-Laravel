<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $trainers = Trainer::get();
        return $this->apiResponse($trainers,'Ok',200);
    }


    public function show($id)
    {
        $trainer = Trainer::find($id);
        if($trainer)
        {
            return $this->apiResponse($trainer,'Ok',200);
        }
        return $this->apiResponse(null,'The Trainer Not Found',404);
    }


    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'trainer_name'  => 'required|max:255',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $trainer = Trainer::create($request->all());
        if($trainer)
        {
            return $this->apiResponse($trainer,'The Trainer Save',201);
        }
        return $this->apiResponse(null,'The Trainer Not Save',400);
    }


    public function update(Request $request ,$id)
    {
        $validator  = Validator::make($request->all(),
        [
            'trainer_name'  => 'required|max:255',
        ]);
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $trainer = Trainer::find($id);
        if(!$trainer)
        {
            return $this->apiResponse(null,'The Trainer Not Found',404);
        }
        $trainer->update($request->all());
        if($trainer)
        {
            return $this->apiResponse($trainer,'The Trainer Update',201);
        }
    }


    public function destroy($id)
    {
        $trainer = Trainer::find($id);
        if(!$trainer)
        {
            return $this->apiResponse(null,'The Trainer Not Found',404);
        }
        $trainer->delete($id);
        if($trainer)
        {
            return $this->apiResponse(null,'The Trainer Deleted',200);
        }
    }
}