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