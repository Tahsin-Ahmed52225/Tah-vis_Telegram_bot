<?php

namespace App\Telegram\Commands;

use App\Service\CommonService;
use Illuminate\Support\Facades\Session;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class TaskCommand extends Command
{
    protected string $name = 'task';
    protected string $description = 'Task Management';
    private $taskService = [
        ['View Task','Task-all'],
        ['Add Task','Task-add'],
        ['Delete Task','Task-delete']
    ];
    protected string $pattern = '{taskAction}';

    public function handle()
    {
        $taskAction = $this->argument('taskAction');
        if ($taskAction){

        }else{
            $updateData = $this->getUpdate();
            $this->replyWithChatAction(['action' => Actions::TYPING]);
            $this->replyWithMessage([
                'text' =>  "Welcome to Task management",
            ]);
            foreach($this->taskService as $taskOption){
                $keyboard[] = [$taskOption];
            }
            $keyboard = json_encode([
                "inline_keyboard" => [
                    [
                        [
                            "text" => "Add",
                            "callback_data" => "task-add"
                        ],
                        [
                            "text" => "Edit",
                            "callback_data" => "task-edit"
                        ],
                        [
                            "text" => "Delete",
                            "callback_data" => "task-delete"
                        ],
                    ],
                    [
                        [
                            "text" => "View All",
                            "callback_data" => "task-all"
                        ],
                    ]
                ]
            ]);
            Telegram::sendMessage([
                'chat_id' => $updateData->message->chat->id,
                'text' => "Choose option...",
                'reply_markup'=> $keyboard,
            ]);

        }


    }
}
