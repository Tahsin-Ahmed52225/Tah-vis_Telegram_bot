<?php

namespace App\Service;

use App\Service\traits\TaskManager;
use Illuminate\Support\Facades\Session;
use Telegram\Bot\Laravel\Facades\Telegram;

class CommonService {
    // Module manager traits
    use TaskManager;


    static public function handle($update){
      if(Session::has("module")){
        switch(Session::get("module")){
            case ""
        }
      }else{
        Telegram::sendMessage([
            'chat_id' => $update->message->chat->id,
            'text' => 'Not module activated... Choose One!',
        ]);

    }


    }
}
