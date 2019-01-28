<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DataFillController extends Controller
{

    /**
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
                $model = $requestData;
                $keyValueDataArr = $this->buildDataArray($value);
                $model['type'] = Arr::get($keyValueDataArr, '0', 'undefined');
                $model['data'] = Arr::get($keyValueDataArr, '1', 0);
                $model['sensor_id'] = $sensor_id;
                $model = new Data($model);
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

    private function buildDataArray($value)
    {
        return [array_keys($value)[0], array_values($value)[0]];
    }
}
