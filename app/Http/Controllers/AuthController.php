<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Resources\UserDetailsResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $credentials = $request->only("email", "password");
        if (!Auth::attempt($credentials)) {
            return response()->json([
                "error" => "Invalid credentials.",
                400
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('auth', ["credit:*"], now()->addHours(4));

        $userResource = new UserDetailsResource($user);

        return response()->json([
            "user" => $userResource,
            "token" => $token->plainTextToken
        ], 200);
    }

    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->name = $validated["name"];
        $user->email = $validated["email"];
        $user->password = Hash::make($validated["password"]);
        $user->save();

        return response()->json([
            "message" => "Registration successful."
        ]);
    }
}
