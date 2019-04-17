<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function edit(\App\Http\Requests\User $request, $id): JsonResponse
    {
        $user = User::find($id);
        $updated = $user->update($request->validated());

        return response()->json([
            'success' => $updated,
            'user' => $user
        ]);
    }
}
