<?php


/**
 * Write code on Method
 *
 * @return response()
 */

use Illuminate\Http\JsonResponse;
use Telegram\Bot\Laravel\Facades\Telegram;

if (!function_exists('JsonApiResponse')) {
    function JsonApiResponse($statusCode, $message, $response)
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $response,
        ]);
    }
}

if (!function_exists('BotResponse')) {
    function BotResponse($userID, $message,)
    {
        Telegram::sendMessage([
            'chat_id' => $userID,
            'text' => $message,
        ]);
    }
}
