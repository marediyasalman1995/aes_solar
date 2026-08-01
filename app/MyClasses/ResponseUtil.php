<?php

namespace App\MyClasses;

class ResponseUtil
{
    /**
     * Format a success response array.
     *
     * @param string $message
     * @param mixed $data
     * @return array
     */
    public static function makeResponse(string $message, $data): array
    {
        return [
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ];
    }

    /**
     * Format an error response array.
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    public static function makeError(string $message, array $data = []): array
    {
        $res = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($data)) {
            $res['data'] = $data;
        }

        return $res;
    }
}
