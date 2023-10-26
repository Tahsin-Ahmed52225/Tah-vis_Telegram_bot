<?php

namespace App\Service\Texts;

use App\Models\Task;
use App\Models\TeleUser;

class TaskTextHandler
{
    public function handle($user, $update)
    {
        $Func = explode('-', $user->state);
        $this->{$Func[0] . $Func[1]}($user->id, $update, $user->state);
    }

    private function taskadd($id, $update, $optional = null)
    {

        $task = Task::store($id, $update->message->text);

        if ($task) {
            BotResponse($update->message->from->id, "Task Added Successfully.");
            TeleUser::where(['client_id' => $update->message->from->id])->update(['state' => '']);
        } else {
            BotResponse($update->message->from->id, 'Something went wrong.');
        }
    }
    private function taskdelete($id, $update, $optional = null)
    {

        $pattern = '/^[0-9]+$/';
        // Only numbers are allowed
        if (preg_match($pattern, $update->message->text)) {
            $inputOption = (int)$update->message->text + 1;
            $taskListIndex = explode('-', $optional);
            // Only numbers withhin the task list are allowed
            if ($inputOption <= count($taskListIndex) - 1) {
                Task::destroy($taskListIndex[$inputOption]);
                BotResponse($update->message->from->id, 'Task deleted succcesfully.');
                TeleUser::where(['client_id' => $update->message->from->id])->update(['state' => '']);
            } else {
                BotResponse($update->message->from->id, "Wrong Input Try Again!");
            }
        } else {
            BotResponse($update->message->from->id, "Wrong Input Try Again!");
        }
    }
}
