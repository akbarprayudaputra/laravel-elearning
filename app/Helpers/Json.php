<?php

namespace App\Helpers;

class Json
{
    public static function success($status = "success", $message = "Success", $data = [], $code = 200)
    {
        if (empty($data)) {
            $data = ["empty"];
        }

        $payload = [
            "status" => $status,
            "message" => $message,
            "data" => $data
        ];

        return response()->json($payload, $code);
    }

    public static function error($status = "error", $message = "Error", $code = 500)
    {

        $payload = [
            "status" => $status,
            "message" => $message,
        ];

        return response()->json($payload, $code);
    }
}
