<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Registration successful',
            'redirectUrl' => 'login',
        ], 200);
    }

    public function login(Request $request) {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return response()->json([
                'status' => false,
                'errors' => [
                    'email' => ['Please add valid email id.']
                ],
            ], 401);
        } else if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'errors' => [
                    'password' => ['Please add valid password.']
                ],
            ], 401);
        }

        Auth::login($user);

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'redirectUrl' => '/dashboard',
        ], 200);
    }

    public function logout(Request $request) {
        auth()->logout();
        return redirect('/login');
    }
}
