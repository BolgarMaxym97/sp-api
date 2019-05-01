<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\NodeType;
use App\Models\Sensor;
use App\Models\SensorIcon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class NodesController extends Controller
{
    public function getNodes(Request $request): array
    {
        return [
            'nodes' => Node::with(['nodeType', 'sensors.sensorType.sensorIcon', 'sensors.lastData'])
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


    public function getLastData(Request $request, $id): Collection
    {
        return Sensor::with(['lastData', 'sensorType', 'node.nodeType'])->where('node_id', $id)->get();
    }

    public function getStatistic(Request $request, $id): array
    {
        $node = Node::with(['sensors.sensorType', 'data'])->find($id);
        $lastData = $node->data()->latest()->first();
        return [
            'node_name' => $node->object_name,
            'node_type' => $node->type_name,
            'sensors_count' => $node->sensors->count(),
            'sensors_types' => $node->sensors->map(function ($sensor) {
                return $sensor->type_name;
            }),
            'created_at' => $node->created_at->format('d.m.Y H:i'),
            'last_data_time' => $lastData ? $lastData->created_at->format('d.m.Y H:i') : '',
            'data_count' => $node->data->count()
        ];
    }

    public function generateFirmware(Request $request, $id)
    {
        $node = Node::with(['sensors'])->find($id);
        try {
            $wifiFile = \File::get(public_path(DIRECTORY_SEPARATOR . 'firmwares' . DIRECTORY_SEPARATOR . 'wi-fi.ino'));
            $sensorFile = \File::get(public_path(DIRECTORY_SEPARATOR . 'firmwares' . DIRECTORY_SEPARATOR . 'sensor.ino'));
        } catch (FileNotFoundException $e) {
            return response()->json(['messages' => ['Файл не найден']], 404);
        }

        foreach ($node->sensors as $sensor) {
            $wifiFile = str_replace(Node::FIRMWARE_NAMES_BY_SENSORS_TYPE[$sensor->type], $sensor->id, $wifiFile);
        }
        return [
            'wi-fi.ino' => $wifiFile,
            'sensor.ino' => $sensorFile
        ];
    }
}
