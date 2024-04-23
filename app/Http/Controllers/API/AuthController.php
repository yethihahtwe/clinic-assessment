<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;

class AuthController extends BaseController
{
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $authUser = Auth::user();
            $success['token'] = $authUser->createToken('MyApi')->plainTextToken;
            $success['user_id'] = $authUser->id;
            $success['name'] = $authUser->name;
            $success['organization'] = $authUser->organization->name;
            $success['position'] = $authUser->position;

            return $this->sendResponse($success, 'User Logged In');
        }else{
            return $this->sendError('Unauthorized.', ['error' => 'Wrong credentials'], 403);
        }
    }
}
