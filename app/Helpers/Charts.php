<?php

namespace App\Helpers;

class Charts
{
    public static function collectDataForMultipleData(...$args)
    {
        $labels = array_keys(call_user_func_array('array_merge', $args));
        $data = [];
        foreach ($labels as $i => $label) {
            foreach ($args as $key => $arg) {
                foreach ($arg as $labelArg => $value) {
                    if ($label !== $labelArg) {
                        $data[$key][$i] = 0;
                    } else {
                        $data[$key][$i] = $value;
                        break;
                    }
                }
            }
        }
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}

