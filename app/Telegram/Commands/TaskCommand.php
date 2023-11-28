<?php

namespace App\Telegram\Commands;


use App\Enums\BotMessage;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class TaskCommand extends Command
{
    protected string $name = 'task';
    protected string $description = 'Task Management';

    /**
     * Handle when task command is called
     */
    public function handle(): void
    {

        $updateData = $this->getUpdate();
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->replyWithMessage([
            'text' =>  BotMessage::WELCOME_TASK_MOD->value,
        ]);
        $keyboard = json_encode([
            "inline_keyboard" => $this->getKeyboard(),
        ]);
        # Sending inline keyboard
        Telegram::sendMessage([
            'chat_id' => $updateData->message->chat->id,
            'text' => BotMessage::CHOOSE_OPTION->value,
            'reply_markup' => $keyboard,
        ]);
    }

    /**
     * Geting task module keyboard options
     */
    private function getKeyboard(): array
    {
        return
            [
                [
                    [
                        "text" => "Add",
                        "callback_data" => "task-add"
                    ],
                    [
                        "text" => "Delete",
                        "callback_data" => "task-delete"
                    ],
                ],
                [
                    [
                        "text" => "View All",
                        "web_app" => [
                            "url" => env('TELEGEAM_WEBAPP_URL'),
                        ]
                    ],
                ]
            ];
    }
}
