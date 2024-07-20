<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Assuming User model exists

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|string',
            'role' => 'required|string',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'status' => $validatedData['status'],
            'role' => $validatedData['role'],
        ]);

        // Optionally, you can log in the user here if needed

        // Return a response, such as JSON
        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }
}
