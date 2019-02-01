<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Sensor;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function getStatistic() : array
    {
        return [
            'customers_count' => User::customers()->count(),
            'sensors_count' => Sensor::count(),
            'objects_count' => Node::count(),
        ];
    }
}
