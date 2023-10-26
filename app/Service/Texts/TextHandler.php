<?php

namespace App\Service\Texts;

use App\Models\TeleUser;
use App\Service\Texts\TaskTextHandler;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TextHandler
{

    static public function handle($update)
    {
        $user = TeleUser::findTeleUserByClientId($update->message->from->id);
        if ($user->state) {
            $state = explode('-', $user->state);
            switch ($state[0]) {
                case 'task':
                    $handlerObj = new TaskTextHandler;
                    $handlerObj->handle($user, $update);
                    break;
            }
        } else {
            BotResponse($update->message->from->id, "No module activated.");
        }
    }
}
