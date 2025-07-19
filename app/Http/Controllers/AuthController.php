<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\User\AuthService;
class AuthController extends Controller
{

    public function login(Request $request){
        $user = AuthService::login($request);
        if($user)
            return $this->responseJSON($user);
        return $this->responseJSON(null, "error", 401);
    }

    public function register(Request $request){
        $user = AuthService::register($request);
        return $this->responseJSON($user);
    }

}
