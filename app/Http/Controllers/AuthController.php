<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Login(LoginRequest $request)
    {
        $data = $request->validated();

        // Attempt to log the user in
        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Email or password are wrong'
            ], 401); // Return 401 Unauthorized status code if authentication fails
        }

        // If authentication is successful
        $user = Auth::user(); // Get the authenticated user
        $token = $user->createToken('main')->plainTextToken; // Create a new token

        return response()->json([ // Return the user and token in JSON format
            'user' => $user,
            'token' => $token
        ]);
    }

    public function Logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response('logout succesfully', 204);
    }
}
