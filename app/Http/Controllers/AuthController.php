<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json('Credentials do not match!', '401');
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'user' => $user,
        ]);
    }
    public function register(RegisterRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::loginUsingId($user->id);

        return response()->json([
            'user' => $user,
        ]);
    }
    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message' => 'You have successfully been logged out...'
        ]);
    }

    public function getUser(){
        $user = Auth()->user();

        return response()->json([
            'user' => $user,
        ]);
    }
}
