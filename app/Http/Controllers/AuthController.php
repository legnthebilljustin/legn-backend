<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $credentials = $request->only("email", "password");

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken($user->id)->plainTextToken;

            return response()->cookie("token", $token, 36000);
        }

        return response()->json([
            "error" => "Invalid credentials.",
            400
        ]);
    }
}
