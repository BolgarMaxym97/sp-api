<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\NodeType;
use App\Models\Sensor;
use App\Models\SensorIcon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class NodesController extends Controller
{
    public function getNodes(Request $request): array
    {
        return [
            'nodes' => Node::with(['nodeType', 'sensors.sensorType.sensorIcon'])
                ->when($request->user_id, function ($query) use ($request) {
                    return $query->where('user_id', $request->user_id);
                })
                ->get(),
            'icons' => SensorIcon::with(['sensorTypeRel'])->get()
        ];
    }

    public function getTypes(): Collection
    {
        return NodeType::all();
    }

    public function create(Request $request): Model
    {
        $this->validate($request, Node::rules());
        return Node::create($request->input())->load(['nodeType', 'sensors.sensorType.sensorIcon']);
    }

    public function update(Request $request, $id): array
    {
        $this->validate($request, Node::rules());
        $node = Node::find($id);
        if (!$node) {
            return response()->json(['messages' => ['Объект не найден']], 404);
        }
        $updated = $node->update($request->input());
        return [
            'success' => $updated,
            'node' => $node->load(['nodeType', 'sensors.sensorType.sensorIcon'])
        ];
    }

    public function remove(Request $request, $id): array
    {
        $node = Node::find($id);
        if (!$node) {
            return response()->json(['messages' => ['Объект не найден']], 404);
        }
        $deleted = $node->delete();
        if ($deleted) {
            Sensor::where(['node_id' => $id])->delete();
        }
        return ['success' => $deleted];
    }
}
