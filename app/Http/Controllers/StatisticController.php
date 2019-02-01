<?php

namespace App\Http\Controllers;

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
                return Carbon::parse($val->created_at)->format('d.m.Y');
            })
            ->map(function ($customers) {
                return collect($customers)->count();
            })
            ->toArray();

        $nodesCountByDates = Node::get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('d.m.Y');
            })
            ->map(function ($customers) {
                return collect($customers)->count();
            })
            ->toArray();

        return [
            'customers_count' => User::customers()->count(),
            'sensors_count' => Sensor::count(),
            'objects_count' => Node::count(),
            'customersCount' => [
                'customersLabelsByDates' => array_keys($customersCountByDates),
                'customersDataByDates' => array_values($customersCountByDates),
            ],
            'nodesCount' => [
                'nodesLabelsByDates' => array_keys($nodesCountByDates),
                'nodesDataByDates' => array_values($nodesCountByDates),
            ],
        ];
    }
}
