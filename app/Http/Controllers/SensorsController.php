<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SensorsController extends Controller
{
    public function getSensors(): Collection
    {
        return Sensor::with('sensorType')->get();
    }

    public function create(Request $request): Model
    {
        $this->validate($request, Sensor::rules());
        return Sensor::create($request->input())->load(['icon', 'sensorType']);
    }
}
