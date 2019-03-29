<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Sensor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DataFillController extends Controller
{

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function fill(Request $request): JsonResponse
    {
        $requestData = $request->all();
        $created = 0;
        try {
            foreach ($requestData['values'] as $sensor_id => $value) {
                $sensor = Sensor::find($sensor_id);
                $lastData = Data::latest('created_at')->first();
                if (!$sensor || \Carbon\Carbon::now()->diffInMinutes($lastData->created_at) < 9) {
                    continue;
                }
                $model = new Data([
                    'data' => $value,
                    'user_id' => $sensor->user_id,
                    'sensor_id' => $sensor_id,
                    'node_id' => $sensor->node_id
                ]);
                $saved = $model->save();
                if ($saved) {
                    $created++;
                }
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e,
            ]);
        }

        return response()->json([
            'success' => true,
            'created' => $created
        ]);
    }
}
