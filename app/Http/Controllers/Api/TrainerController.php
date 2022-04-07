<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trainer;

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

}
