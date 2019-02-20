<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CustomersController extends Controller
{
    public function getCustomers() : Collection
    {
        return User::customers()->with(['nodes'])->get();
    }
}
