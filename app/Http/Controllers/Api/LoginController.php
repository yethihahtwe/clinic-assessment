<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiController as ApiController;

class LoginController extends ApiController
{
    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]))
        {
            $user = Auth::user();
            $result['token'] = $user->createToken('token')->plainTextToken;
            $result['user_id'] = $user->id;
            $result['name'] = $user->name;
            $result['organization'] = $user->organization->name;
            $result['organization_id'] = $user->organization_id;
            $result['position'] = $user->position ?? '';
            $result['avatar'] = $user->avatar ?? '/storage/' . $user->avatar;

            return $this->sendResponse($result, 'Logged in successfully.');
        }
        else
        {
            return $this->sendError('Authorization Failed', 'Invalid login credentials', 403);
        }
    }
}
