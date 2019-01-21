<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected function create(Request $request) : JsonResponse
    {
        $this->validate($request, User::rules());
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        Auth::attempt(['email' => $user->email, 'password' => $user->password]);
        $token = $user->createToken('AppClient')->accessToken;

        return response()->json(['token' => $token, 'user' => $user], 200);
    }

    protected function login(Request $request) : JsonResponse
    {
        Auth::attempt($request->all());
        $user = Auth::user();
        $token = $user->createToken('AppClient')->accessToken;
        return response()->json(['token' => $token, 'user' => $user], 200);
    }
}
