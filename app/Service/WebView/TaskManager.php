<?php

namespace App\Service\WebView;

use App\Models\Task;
use App\Models\TeleUser;

class TaskManager
{
    private $activeUserID;

    public function __construct($userID)
    {
        $this->activeUserID = base64_decode(urldecode($userID));
    }

    public function getTasks()
    {
        $user =  TeleUser::with('tasks')->where('client_id', $this->activeUserID)->first();
        return $user->tasks;
    }

    public function updateTask($task)
    {
        $task = Task::find($task["id"]);
        $task->complete = $task["complete"] ? 0 : 1;
        $task->save();

        return $task;
    }
}
