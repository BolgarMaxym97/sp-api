<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Database\Eloquent\Collection;

class SensorsController extends Controller
{
    public function getSensors() : Collection
    {
        return Sensor::with('sensorType')->get();
    }
}
