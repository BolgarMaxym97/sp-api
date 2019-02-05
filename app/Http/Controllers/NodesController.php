<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class NodesController extends Controller
{
    public function getNodes(Request $request): Collection
    {
        $nodes = Node::with(['nodeType', 'sensors.icon']);
        if ($request->user_id) {
            $nodes->where(['user_id' => $request->user_id]);
        }
        return $nodes->get();
    }
}
