<?php

namespace App\Http\Controllers;

use App\Helpers\Charts;
use App\Models\Node;
use App\Models\Sensor;
use App\Models\User;
use Carbon\Carbon;

class StatisticController extends Controller
{
    public function getStatistic(): array
    {
        $customersCountByDates = User::customers()
            ->get()
            ->groupBy(function ($val) {
                return strtotime(Carbon::parse($val->created_at)->format('d.m.Y'));
            })
            ->map(function ($customers) {
                return collect($customers)->count();
            })
            ->toArray();

        $nodesCountByDates = Node::get()
            ->groupBy(function ($val) {
                return strtotime(Carbon::parse($val->created_at)->format('d.m.Y'));
            })
            ->map(function ($customers) {
                return collect($customers)->count();
            })
            ->toArray();

        return [
            'customers_count' => User::customers()->count(),
            'sensors_count' => Sensor::count(),
            'nodes_count' => Node::count(),
            'customersCountByDates' => array_map(function ($customer, $key) {
                return [$key * 1000, $customer];
            }, $customersCountByDates, array_keys($customersCountByDates)),
            'nodesCountByDates' => array_map(function ($node, $key) {
                return [$key * 1000, $node];
            }, $nodesCountByDates, array_keys($nodesCountByDates))
        ];
    }
}
