<?php

namespace Mercury\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mercury\Http\Controllers\Controller;
use Mercury\User;
use Validator;

class AuthAPI extends Controller
{
    public function login(Request $req)
    {
        $credentials = $req->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $req->email)->get();
            return response()->json([
                "user" => $user[0],
                "message" => "success",
            ], 200);
        } else {
            return response()->json([
                "message" => "check your password and email",
            ], 500);
        }
    }

    public function register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255|min:3|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 500);
        } else {
            return response()->json(["name" => "Das"], 200);
        }
    }
}
