<?php

namespace App\Helpers;

class Json
{
    public static function success($status = "success", $message = "Success", $data = [], $code = 200)
    {
        $payload = [
            "status" => $status,
            "message" => $message,
            "data" => $data
        ];

        return response()->json($payload, $code);
    }
}
