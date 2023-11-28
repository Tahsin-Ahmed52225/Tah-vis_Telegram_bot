<?php

use Illuminate\Http\JsonResponse;
use Telegram\Bot\Laravel\Facades\Telegram;

if (!function_exists('JsonApiResponse')) {
    /**
     * Formatting JSON response
     */
    function JsonApiResponse(Int $statusCode, String $message, Mixed $response): JsonResponse
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $response,
        ]);
    }
}

if (!function_exists('BotResponse')) {
    /**
     * Formatting BOT message response
     */
    function BotResponse(String $userID, String $message,)
    {
        Telegram::sendMessage([
            'chat_id' => $userID,
            'text' => $message,
        ]);
    }
}
