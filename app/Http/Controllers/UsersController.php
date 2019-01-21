<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UsersController extends Controller
{
    public function getUsers() : Collection
    {
        return User::all();
    }
}
