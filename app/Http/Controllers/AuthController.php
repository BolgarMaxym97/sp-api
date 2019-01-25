<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{
    protected function create(Request $request): JsonResponse
    {
        $this->validate($request, User::rules());
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        return response()->json([
            'success' => (bool)$user,
            'user' => $user
        ]);
    }

    protected function login(Request $request): JsonResponse
    {
        Auth::attempt($request->all());
        $user = Auth::user();
        $tokenInfo = $user->createToken('AppClient');
        return response()->json([
            'token' => [
                'token' => $tokenInfo->accessToken,
                'expires_at' => $tokenInfo->token->expires_at,
                'expires' => Carbon::now()->diff(new Carbon($tokenInfo->token->expires_at))->days
            ],
            'user' => $user
        ]);
    }
}
