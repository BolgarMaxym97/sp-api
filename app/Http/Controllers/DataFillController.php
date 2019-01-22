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
    public function fill(Request $request) : JsonResponse
    {
        $requestData = $request->all();
        $created = 0;
        foreach (json_decode($requestData['json']) as $type => $value) {
            $modelData = $requestData;
            $modelData['type'] = $type;
            $modelData['data'] = $value;
            $model = new Data($modelData);
            // Todo: delete later
            $logger = new \App\Helpers\Logger('fill', $modelData);
            $logger->writeLog();
            $saved =  $model->save();
            if ($saved) {
                $created++;
            }
        }

        return response()->json([
            'success' => true,
            'created' => $created
        ]);
    }
}
