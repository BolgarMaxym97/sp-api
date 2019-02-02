<?php
namespace App\Helpers;

class Charts {

    // TODO: DONE
    public static function collectDataForMultipleData(...$args) {
        $test = $args;
        return [
            'labels' => [],
            'data' => [
                'customersDataByDates' => [],
                'nodesDataByDates' => [],
            ]
        ];
    }
}

