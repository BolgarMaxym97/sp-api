<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataFillController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function fill(Request $request)
    {
        $givenData = $request->all();
        $dataModel = new Data($givenData);
        // Todo: delete later
        $logger = new \App\Helpers\Logger('fill', $givenData);
        $logger->writeLog();

        return response()->json([
            'success' => $dataModel->save()
        ]);
    }
}
