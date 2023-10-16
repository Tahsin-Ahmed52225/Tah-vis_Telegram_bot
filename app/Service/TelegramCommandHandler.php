<?php

namespace App\Service;

use App\Enum\TelegramCommands;

class TelegramCommandHandler{

    public function commandChecker(string $message): null|bool
    {
        $commandName = substr($message, 1);
        if (TelegramCommands::tryFrom($commandName) != null)
        {
            $this->{$commandName}();
        }
        else
        {
            return false;
        }
    }
    private function start(){
        dd("Ting Ting");
    }
    private function stop(){
        dd("Tong Tong");
    }

}
