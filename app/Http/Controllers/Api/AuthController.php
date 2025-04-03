<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate request fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the user exists
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['errors' => ['email' => ['No account found with this email.']]], 422);
        }

        // Check if the password is correct
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['errors' => ['password' => ['Incorrect password.']]], 422);
        }

        // Authenticate and generate token
        $user = $request->user();
        $token = $user->createToken('API Token')->plainTextToken;
        $user->load(['roles.permissions']); // Load related data

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ]);
    }


    // Logout method
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }


    public function getRoles()
    {
        return response()->json([
            "roles" => Role::whereNotIn('name', ['root', 'admin'])->select('id', 'name')->get()
        ]);
    }
}
