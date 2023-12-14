<?php

namespace App\Http\Response;

use Illuminate\Http\Response;

class ApiResponse
{
    public static function created($data, $message = 'Successfully created!', $status_code = Response::HTTP_CREATED)
    {
        return response()->json([
            'data' => $data,
            'type' => 'success',
            'message' => $message,
        ], $status_code);
    }

    public static function updated($data, $message = 'Successfully updated!', $status_code = Response::HTTP_OK)
    {
        return response()->json([
            'data' => $data,
            'type' => 'success',
            'message' => $message,
        ], $status_code);
    }

    public static function deleted($data, $message = 'Successfully deleted!', $status_code = Response::HTTP_NO_CONTENT)
    {
        return response()->json([
            'data' => $data,
            'type' => 'warning',
            'message' => $message,
        ], $status_code);
    }

    public static function success($data, $message, $status_code = Response::HTTP_OK)
    {
        return response()->json([
            'data' => $data,
            'type' => 'success',
            'message' => $message,
        ], $status_code);
    }

    public static function error($data, $message, $status_code = Response::HTTP_NOT_FOUND)
    {
        return response()->json([
            'data' => $data,
            'type' => 'error',
            'message' => $message,
        ], $status_code);
    }
}
