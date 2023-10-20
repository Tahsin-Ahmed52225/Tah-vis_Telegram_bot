<?php

namespace App\Http\Controllers;

use App\Service\Callbacks\CallbackHandler;
use App\Service\CommonService;
use Telegram\Bot\Laravel\Facades\Telegram;

class BotController extends Controller
{
    public function botHandler(){
        # handles if response is command
        $update = Telegram::commandsHandler(true);
        # handles if response is data
        if(!isset($update->message->entities) && !isset($update->callback_query)){
          CommonService::handle($update);
        # handles if response is a callback query
        }else if(!isset($update->message->entities) && isset($update->callback_query)){
          return CallbackHandler::handle($update);
        }
         return $update;

    }
}
