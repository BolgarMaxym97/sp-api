<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\NodeType;
use App\Models\SensorIcon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

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

    public function getTypes() : Collection
    {
        return NodeType::all();
    }

    public function create(Request $request) : Model
    {
        $this->validate($request, Node::rules());
        return Node::create($request->input());
    }
}
