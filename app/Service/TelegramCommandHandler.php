<?php

namespace App\Service;

use App\Enum\TelegramCommands;
use App\Models\TeleUser;
use Illuminate\Support\Facades\Log;

class TelegramCommandHandler{

    public function commandChecker(object $request): string|bool
    {
        Log::debug($request);
        $message = $request['message']['text'] ?? '/start';
        $commandName = substr($message, 1);
        if (TelegramCommands::tryFrom($commandName) != null)
        {

            return $this->{$commandName}($request);;
        }
        else
        {
            return false;
        }
    }
    private function start(object $request){
        $clientID = $request['message']['from']['id'];
        $user = TeleUser::findTeleUserByClientId($clientID);
        if(count($user) != 0){
            return "Welcome back ".$request['message']['from']['first_name'];

        }else{
            TeleUser::store($request['message']['from']);
            return "Hello ".$request['message']['from']['first_name']. " How can I help you?";

        }
    }
    private function stop(object $request){
        dd("Tong Tong");
    }

}
