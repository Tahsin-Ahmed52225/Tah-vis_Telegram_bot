<?php


/**
 * Write code on Method
 *
 * @return response()
 */

use Illuminate\Http\JsonResponse;

if (! function_exists('apiResponse')) {
    function JsonApiResponse($statusCode, $message , $response)
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $response,
        ]);
    }
}
