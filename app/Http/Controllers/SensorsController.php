<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Sensor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SensorsController extends Controller
{
    public function getSensors(): Collection
    {
        return Sensor::with('sensorType')->get();
    }

    public function getSensor(Request $request, $id): array
    {
        $date = $request->input('date');
        $sensor = Sensor::find($id);
        $data = Data::whereDate('created_at', Carbon::parse($date))->where(['sensor_id' => $id])->get()
            ->map(function ($dataItem) {
                return [
                    'x' => Carbon::parse($dataItem->created_at)->format('d.m.Y H:i'),
                    'y' => $dataItem->data,
                ];
            })->toArray();

        return [
            'sensor' => $sensor,
            'data' => Arr::pluck($data, 'y'),
            'labels' => Arr::pluck($data, 'x')
        ];
    }

    public function create(Request $request): Model
    {
        $this->validate($request, Sensor::rules());
        return Sensor::create($request->input())->load(['sensorType.sensorIcon']);
    }
}
