<?php

namespace App\Service\Callbacks;

use App\Enums\BotMessage;
use App\Models\TeleUser;

class TaskCallbackHandler
{
    /**
     * Handling Task Module callback
     *
     * @param  string $action
     * @param  string $userID
     * @return void
     */
    public function handle($action, $userID)
    {
        $this->{$action}($userID);
    }

    /**
     * Task add callback response and set User state to add task
     */
    private function taskadd(string $userID): void
    {

        $userObj = TeleUser::findTeleUserByClientId($userID);
        if ($userObj) {
            BotResponse($userID, BotMessage::ADD_TASK->value);
            # Setting user state to add task
            $userObj->state =  'task-add';
            $userObj->save();
        } else {
            BotResponse($userID, BotMessage::ERROR->value);
        }
    }
    /**
     * Task delete callback response and set User state to delete task
     */
    private function taskdelete(string $userID): void
    {
        $userObj = TeleUser::findTeleUserByClientId($userID);
        if ($userObj) {
            BotResponse($userID, BotMessage::DELETE_TASK->value);
            # Getting a particular user all task
            $user =  TeleUser::with('tasks')->where('client_id', $userID)->first();
            $taskList = '';
            $delIndex = '';
            # Ready the tasklist for delete
            foreach ($user->tasks as $key => $task) {
                $status = ($task->complete) ? 'COMPLETE' : 'TODO';
                $taskList = $taskList . $key + 1 . '=> ' . $task->task . ' [' . $status . ']' . "\n";
                $delIndex = $delIndex . '-' . $task->id;
            }
            BotResponse($userID, $taskList);

            $userObj->state =  'task-delete' . $delIndex;
            $userObj->save();
        } else {
            BotResponse($userID, BotMessage::ERROR->value);
        }
    }
}
