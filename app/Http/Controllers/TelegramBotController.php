<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    public function updatedActivity()
    {
        $activity = Telegram::getUpdates();
        dd($activity);
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
        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
            'parse_mode' => 'HTML',
            'text' => "Message received"
        ]);

    }

}
