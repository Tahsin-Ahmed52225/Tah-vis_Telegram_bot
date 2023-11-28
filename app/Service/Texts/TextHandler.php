<?php

namespace App\Service\Texts;

use App\Enums\BotMessage;
use App\Models\TeleUser;
use App\Service\Texts\TaskTextHandler;

class TextHandler
{

    /**
     * Handling normal user text messages
     */
    static public function handle(mixed $update): void
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
            BotResponse($update->message->from->id, BotMessage::NO_MODULE->value);
        }
    }
}
