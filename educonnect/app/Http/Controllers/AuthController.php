<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

        public function register(RegisterRequest $request){

        $user = User::create($request->validated());

        return ['user' => $user];
        }


      public function login(LoginRequest $request){
        if (!Auth::attempt($request->only('email', 'password')))
            return response()->json(['message'=>'Invalid credentials'], 401);
        
        $user=User::where('email', $request->email)->FirstOrFail();
        $token= $user->createToken('auth_token')->plainTextToken;
        return Response()->json(['message'=>'logged in','user'=>$user,'token'=>$token]);

       
     }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
