<?php

namespace App\Service;

use App\Service\traits\TaskManager;
use Illuminate\Support\Facades\Session;
use Telegram\Bot\Laravel\Facades\Telegram;

class CommonService {
    // Module manager traits
    use TaskManager;


    static public function handle($update){



    Telegram::sendMessage([
        'chat_id' => $update->message->chat->id,
        'text' => Session::has("module"),
    ]);
      if(Session::has("module")){
        Telegram::sendMessage([
            'chat_id' => $update->message->chat->id,
            'text' => 'Task module working on...',
        ]);
      }else{
        Telegram::sendMessage([
            'chat_id' => $update->message->chat->id,
            'text' => 'Not module activated... Choose One!',
        ]);

    }


    }
}
