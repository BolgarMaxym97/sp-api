<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $modelData = $requestData;
        try {
            foreach ($requestData['values'] as $type => $value) {
                $modelData['type'] = $type;
                $modelData['data'] = $value ?: 0;
                $model = new Data($modelData);;
                $saved = $model->save();
                if ($saved) {
                    $created++;
                }
            }
        } catch (\Exception $e) {
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
