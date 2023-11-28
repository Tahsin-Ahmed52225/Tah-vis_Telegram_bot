<?php

namespace App\Http\Controllers;

use App\Service\Callbacks\CallbackHandler;
use App\Service\Texts\TextHandler;
use Telegram\Bot\Laravel\Facades\Telegram;

class BotController extends Controller
{
    /**
     * Bot handler controller
     */
    public function botHandler()
    {
        # handles if response is command
        $update = Telegram::commandsHandler(true);
        # handles if response is data
        if (!isset($update->message->entities) && !isset($update->callback_query)) {
            TextHandler::handle($update);
            # handles if response is a callback
        } else if (!isset($update->message->entities) && isset($update->callback_query)) {
            CallbackHandler::handle($update);
        }
    }
}
