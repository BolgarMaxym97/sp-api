<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
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

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function remove(Request $request, $id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['messages' => ['Пользователь не найден']], 404);
        }
        return response()->json([
            'success' => $user->delete(),
        ]);
    }

    public function getCustomers(): Collection
    {
        return User::customers()->with(['nodes'])->get();
    }

    public function getAdmins(): Collection
    {
        return User::admins()->get();
    }
}
