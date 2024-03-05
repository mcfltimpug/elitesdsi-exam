<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function createUser(Request $request){

        $validateUser = Validator::make($request->all(), [
            "name"=> "required",
            "username" => "required|unique:users,username",
            "email" => "required|email|unique:users,email",
            "password"=> "required",
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }


        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "username" => $request->username,
        ]);

        return response()->json([
            "status"=> "success",
            "message"=> "User Created Successfully",
            "token" => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }

    public function loginUser(Request $request){
        $validateUser = Validator::make($request->all(), [
            "username" => "required",
            "password" => "required",
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        if(!Auth::attempt($request->only(['username', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Username and Password is Invalid.'
            ], 401);
        }

        $user = User::where('username', $request->username)->first();

        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);

    }

    public function logoutUser(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'User Logged Out Successfully'
        ], 200);
    }


}
