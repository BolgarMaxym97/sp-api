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
    /**
     * @param Request $request
     * @return Collection
     */
    public function getSensors(Request $request): Collection
    {
        return Sensor::with(['sensorType', 'settings'])
            ->when($request->node_id, function ($query) use ($request) {
                return $query->where('node_id', $request->node_id);
            })
            ->get();
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function getSensor(Request $request, $id): array
    {
        $date = $request->date;
        $sensor = Sensor::with(['sensorType', 'settings'])->find($id);
        $data = Data::whereDate('created_at', Carbon::parse($date))->where(['sensor_id' => $id])->orderBy('created_at')->get()
            ->map(function ($dataItem) {
                return [Carbon::parse($dataItem->created_at)->getTimestamp() * 1000, $dataItem->data,
                ];
            })->toArray();

        return [
            'sensor' => $sensor,
            'data' => $data,
        ];
    }

    public function create(Request $request): Model
    {
        $this->validate($request, Sensor::rules());
        return Sensor::create($request->input())->load(['sensorType.sensorIcon']);
    }
}
