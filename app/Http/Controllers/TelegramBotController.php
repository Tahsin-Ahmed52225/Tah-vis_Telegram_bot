<?php

namespace App\Http\Controllers;

use App\Models\TeleUser;
use App\Service\TelegramCommandHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    private  $TelegramCommandService;
    public function __construct()
    {
        $this->TelegramCommandService = new TelegramCommandHandler;
    }
    public function updatedActivity()
    {
        $message = "/start";
        $this->TelegramCommandService->commandChecker($message);
    }
    public function storeMessage(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email',
        //     'message' => 'required'
        // ]);

        $text = $request->text;
        for ($counter=0; $counter <= $request->interation ; $counter++) {
            Telegram::sendMessage([
                'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                'parse_mode' => 'HTML',
                'text' => $text
            ]);
          }


       dd("Successfully Send Message");
    }
    public function botUpdate(Request $request){

        $reply = $this->TelegramCommandService->commandChecker($request);
        if($reply != false){
            Telegram::sendMessage([
                'chat_id' => $request['message']['from']['id'],
                'parse_mode' => 'HTML',
                'text' => $reply
            ]);
        }else{
            Telegram::sendMessage([
                'chat_id' => $request['message']['from']['id'],
                'parse_mode' => 'HTML',
                'text' => "Message received"
            ]);

        }

    }

}
