<?php

namespace App\Service\Callbacks;

use App\Models\TeleUser;

class TaskCallbackHandler
{
    public function handle($action, $userID)
    {
        $this->{$action}($userID);
    }

    private function taskadd($userID)
    {

        $userObj = TeleUser::findTeleUserByClientId($userID);
        if ($userObj) {
            BotResponse($userID, "Enter you task");
            $userObj->state =  'task-add';
            $userObj->save();
        } else {
            BotResponse($userID, "Something went wrong try again");
        }
    }
    private function taskdelete($userID)
    {
        $userObj = TeleUser::findTeleUserByClientId($userID);
        if ($userObj) {
            BotResponse($userID, "Enter the number of the task to delete");
            // Getting a particular user all task
            $user =  TeleUser::with('tasks')->where('client_id', $userID)->first();
            $taskList = '';
            $delIndex = '';
            foreach ($user->tasks as $key => $task) {
                $status = ($task->complete) ? 'COMPLETE' : 'TODO';
                $taskList = $taskList . $key + 1 . '=> ' . $task->task . ' [' . $status . ']' . "\n";
                $delIndex = $delIndex . '-' . $task->id;
            }
            BotResponse($userID, $taskList);

            $userObj->state =  'task-delete' . $delIndex;
            $userObj->save();
        } else {
            BotResponse($userID, "Something went wrong try again");
        }
    }
}
