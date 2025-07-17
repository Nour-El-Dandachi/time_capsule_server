<?php

namespace App\Services\User;

use App\Models\Capsule;

class CapsuleService{

    static function getAllCapsules($id = null){
        if(!$id){
            return Capsule::all();
        }
        return Capsule::find($id);
    }

    static function getRevealedCapsules($id = null){
        if($id){
            return Capsule::where("user_id", $id)->where("is_revealed", 1)->get();
        }
        return Capsule::where("visibility", "public")->where("is_revealed", 1)->get();
    }

    static function getClosedCapsules($id){
        if($id){
            return Capsule::where("user_id", $id)->where("is_revealed", 0)->get();
        }
    }

    static function createOrUpdateCapsules(){
       
    }

}
