<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Capsule;
use  App\Services\User\CapsuleService;
use Illuminate\Http\Request;

class CapsuleController extends Controller
{
    function getAllCapsules($id = null){
        $capsules = CapsuleService::getAllCapsules($id);
        return $this->responseJSON($capsules);
    }

    function getRevealedCapsules($user_id  = null){
        $capsules = CapsuleService::getRevealedCapsules($user_id );
        return $this->responseJSON($capsules);
    }

    function getClosedCapsules($user_id ){
        $capsules = CapsuleService::getClosedCapsules($user_id );
        return $this->responseJSON($capsules);
    }

    function addOrUpdateCapsule(Request $request, $id = null){
        $capsule = new Capsule;
        if($id){
            $capsule = CapsuleService::getAllCapsules($id);
        }

        $data = $request->all();

        $capsule = CapsuleService::createOrUpdateCapsules($data, $capsule);
        if($capsule){
            return $this->responseJSON($capsule);
        }
        return $this->responseJSON($capsule, "error", 400);

    }

}
