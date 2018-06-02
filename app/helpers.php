<?php
if (! function_exists('pr')) {
    function pr($value) {
       echo '<pre>';
       print_r($value);
       echo '</pre>';
    }
}

if (! function_exists('format2')) {
    function format2($value) {
       return number_format($value, 2, '.', ',');
    }
}

if (! function_exists('object_to_array')) {
    function object_to_array($object) {
        return (array) $object;
    }
}

if (! function_exists('array_to_object')) {
    function array_to_object($array) {
        return (object) $array;
    }
}

if (! function_exists('compute_monthly_due')) {
    function compute_monthly_due($amount, $terms) {
        $interest = $amount * $_ENV['INTEREST_PER_MONTH'] * $terms;
        return ($amount + $interest)/$terms;
    }
}
