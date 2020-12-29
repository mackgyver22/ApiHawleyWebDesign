<?php

namespace app\services;

class Utils
{
    public static function printArray($arr, $jsonEncode=false) {
        if ($jsonEncode) {
            header("Content-type: application/json");;
            echo json_encode($arr, true);
        } else {
            echo "<pre>" . print_r($arr, true) . "\n</pre>";
        }
    }
}