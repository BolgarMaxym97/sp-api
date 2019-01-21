<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getUsers() : Collection
    {
        return User::all();
    }

    protected function create(Request $request) : JsonResponse
    {
        $this->validate($request, User::rules());
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $token = $user->createToken('AppClient')->accessToken;

        return response()->json(['token' => $token, 'user' => $user], 200);
    }
}
