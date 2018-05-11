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