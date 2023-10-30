<?php

if (!function_exists('success')) {
    function success($data, $status_code = 200) {
        return response()->json([
           'success' => true,
            'data' => $data
        ], $status_code);
    }
}

if (!function_exists('error')) {
    function error($data, $status_code = 400) {
        return response()->json([
            'success' => false,
            'data' => $data
        ], $status_code);
    }
}