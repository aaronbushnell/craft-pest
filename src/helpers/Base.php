<?php

namespace markhuot\craftpest\helpers\base;

use Illuminate\Support\Collection;

if (!function_exists('collection_wrap')) {
    function collection_wrap($value) {
        return is_a($value, Collection::class) ? $value : collect()->push($value);
    }
}

if (!function_exists('array_wrap')) {
    function array_wrap($value) {
        if (is_array($value)) {
            return $value;
        }

        if (empty($value)) {
            return [];
        }

        return [$value];
    }
}
