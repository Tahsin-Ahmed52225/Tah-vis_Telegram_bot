<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class TaskCommand extends Command
{
    protected string $name = 'task';
    protected string $description = 'Activate task management';

    public function handle()
    {
        $updateData = $this->getUpdate();
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->replyWithMessage([
            'text' =>  "Task management activated..",
        ]);
        $keyboard = [
            ["Add Task"],
            ["View Task"],
        ];
        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);
            Telegram::sendMessage([
                'chat_id' => $updateData->message->chat->id,
                'text' => "Choose option...",
                'reply_markup'=> $reply_markup,
            ]);
    }
}
