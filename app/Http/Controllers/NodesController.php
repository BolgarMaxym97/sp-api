<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Database\Eloquent\Collection;

class NodesController extends Controller
{
    public function getNodes() : Collection
    {
        return Node::with('nodeType')->get();
    }
}
