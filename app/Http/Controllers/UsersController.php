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
        $this->validate($request, [
            'username' => ['required', 'string', 'max:255'],
            'name_first' => ['required'],
            'name_last' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6']
        ]);

        $user = User::create([
            'username' => request('username'),
            'name_first' => request('name_first'),
            'name_last' => request('name_last'),
            'phone' => request('phone'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);

        $token = $user->createToken('AppClient')->accessToken;

        return response()->json(['token' => $token], 200);
    }
}
