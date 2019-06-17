<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends Controller
{
    // TODO: remove after presentation
    const TEMPORARY_USER_DATA_FOR_DEMO = [
        'email' => 'admin@gmail.com',
        'password' => '123456',
        'is_customer' => 0,
    ];

    protected function create(\App\Http\Requests\User $request): JsonResponse
    {
        $user = User::create($request->validated());
        return response()->json([
            'success' => (bool)$user,
            'user' => $user
        ], 201);
    }

    protected function login(Request $request): JsonResponse
    {
        // TODO: change back after presentation
        $authed = Auth::attempt(self::TEMPORARY_USER_DATA_FOR_DEMO);
        if (!$authed) {
            return response()->json(['messages' => ['Пользователь не найден']], 404);
        }
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
