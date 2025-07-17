<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use  App\Services\User\CapsuleService;
use Illuminate\Http\Request;

class CapsuleController extends Controller
{
    function getAllCapsules($id = null){
        $capsules = CapsuleService::getAllCapsules($id);
        return $this->responseJSON($capsules);
    }

    function getRevealedCapsules($id = null){
        $capsules = CapsuleService::getRevealedCapsules($id);
        return $this->responseJSON($capsules);
    }
}
