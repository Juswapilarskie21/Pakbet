<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        // Validate request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|numeric|digits_between:10,15',
            'address' => 'required|string|max:500',
        ]);

        // Create user
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'user_type' => 'customer',
        ]);

        // Generate authentication token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return success response
        return response()->json([
            'message' => 'User registered successfully',
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'user_type' => $user->user_type,
            ],
            'token' => $token,
        ], 201);
    }


    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // Check if user exists and verify password
        if (!$user || !Hash::check($request->password, $user->password)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Invalid email or password'], 401);
            }
            return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
        }
        Auth::login($user);
        // Generate authentication token for API users
        $token = $user->createToken('auth_token')->plainTextToken;

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Login successful',
                'user' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'user_type' => $user->user_type,
                ],
                'token' => $token,
            ], 200);
        }


        return redirect()->route('dashboard')->with('success', 'Login successful');
    }

    
    public function logout(Request $request)
{
    // Log out the user
    Auth::logout();

    // Invalidate the session (optional but recommended)
    $request->session()->invalidate();

    // Regenerate the session token (optional but recommended)
    $request->session()->regenerateToken();

    // Redirect the user to the login page with a success message
    return redirect()->route('login.page')->with('success', 'You have been logged out successfully');
}


}
