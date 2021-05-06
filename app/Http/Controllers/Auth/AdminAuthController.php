<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;

class AdminAuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:admins,email",
            "password" => "required|confirmed",
        ]);

        $validatedData['password'] = bcrypt($request->password);
        $admin = Admin::create($validatedData);
        $accessToken = $admin->createToken('authToken')->accessToken;

        return response(['user' => $admin, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            "email" => "email|required",
            "password" => "required",
        ]);

        if (!Auth::guard('admin')->attempt($loginData)) {
            return response(['message' => 'Dados inválidos']);
        }

        $accessToken = Auth::guard('admin')->user()->createToken('authToken')->accessToken;

        return response(['user' => Auth::guard('admin')->user(), 'access_token' => $accessToken]);
    }
}
