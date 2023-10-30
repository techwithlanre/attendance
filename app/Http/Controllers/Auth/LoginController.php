<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request) 
    {
        $user = User::where("email", $request->email)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email/password combination'
            ]);
        }

        if(!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email/password combination'
            ]);
        }


        //genrate api token;
        $user->tokens()->delete(); //delete prvioud generated  api tokens
        $token = $user->createToken('auth')->plainTextToken;
        //2|hlVUA2QSws15V7JQqRBggtOo5lR7GqPoY9FaBvf768779860
        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'token'=> $token,
            ]
        ]);
    }
}
