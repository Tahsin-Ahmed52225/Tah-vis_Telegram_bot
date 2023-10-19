<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Session;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class TaskCommand extends Command
{
    protected string $name = 'task';
    protected string $description = 'Activate task management';
    private $taskService = ['View Task', 'Add Task', 'Delete Task'];

    public function handle()
    {
        $updateData = $this->getUpdate();
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->replyWithMessage([
            'text' =>  "Task management activated..",
        ]);
        foreach($this->taskService as $taskOption){
            $keyboard[] = [$taskOption];
        }

        $reply_markup =  Keyboard::make([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);
        Telegram::sendMessage([
            'chat_id' => $updateData->message->chat->id,
            'text' => "Choose option...",
            'reply_markup'=> $reply_markup,
        ]);

        // Put the module name in session
        Session::put('module', 'TaskManager');
        Session::save();
    }
}
