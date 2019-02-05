<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\SensorIcon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class NodesController extends Controller
{
    public function getNodes(Request $request): array
    {
        $nodes = Node::with(['nodeType', 'sensors.sensorType.sensorIcon']);
        if ($request->user_id) {
            $nodes->where(['user_id' => $request->user_id]);
        }
        return [
            'nodes' => $nodes->get(),
            'icons' => SensorIcon::all()
        ];
    }
}
