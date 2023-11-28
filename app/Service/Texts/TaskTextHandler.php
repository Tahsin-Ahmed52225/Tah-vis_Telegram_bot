<?php

namespace App\Service\Texts;

use App\Enums\BotMessage;
use App\Models\Task;
use App\Models\TeleUser;

class TaskTextHandler
{
    /**
     * Handle  text when user is in Task state
     */
    public function handle(mixed $user, mixed $update): void
    {
        $Func = explode('-', $user->state);
        $this->{$Func[0] . $Func[1]}($user->id, $update, $user->state);
    }

    /**
     *  Handle Task Add text when user is in Task state
     */
    private function taskadd(string $id, mixed $update, mixed $optional = null): void
    {

        $task = Task::store($id, $update->message->text);

        if ($task) {
            BotResponse($update->message->from->id, BotMessage::ADD_TASK_SUCCESS->value);
            TeleUser::where(['client_id' => $update->message->from->id])->update(['state' => '']);
        } else {
            BotResponse($update->message->from->id, BotMessage::ERROR->value);
        }
    }

    /**
     *  Handle Task Delete text when user is in Task state
     */
    private function taskdelete(string $id, mixed $update, mixed $optional = null)
    {

        $pattern = '/^[0-9]+$/';
        # Only numbers are allowed
        if (preg_match($pattern, $update->message->text)) {
            $inputOption = (int)$update->message->text + 1;
            $taskListIndex = explode('-', $optional);
            # Only numbers withhin the task list are allowed
            if ($inputOption <= count($taskListIndex) - 1) {
                Task::destroy($taskListIndex[$inputOption]);
                BotResponse($update->message->from->id, BotMessage::DELETE_TASK_SUCCESS->value);
                TeleUser::where(['client_id' => $update->message->from->id])->update(['state' => '']);
            } else {
                BotResponse($update->message->from->id, BotMessage::WRONG_INPUT->value);
            }
        } else {
            BotResponse($update->message->from->id, BotMessage::WRONG_INPUT->value);
        }
    }
}
