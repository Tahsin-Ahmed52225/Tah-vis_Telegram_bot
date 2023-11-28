<?php

namespace App\Service\WebView;

use App\Models\Task;
use App\Models\TeleUser;

class TaskManager
{
    private string $activeUserID;

    /**
     * constructor
     */
    public function __construct(string $userID)
    {
        # Storing the decoded UserID
        $this->activeUserID = base64_decode(urldecode($userID));
    }

    /**
     * Getting all task of a particular user
     */
    public function getTasks(): mixed
    {
        $user =  TeleUser::with('tasks')->where('client_id', $this->activeUserID)->first();
        return $user->tasks;
    }

    /**
     * Getting all task of a particular user
     */
    public function updateTask(mixed $task): Task
    {
        $task = Task::find($task["id"]);
        $task->complete = $task["complete"] ? 0 : 1;
        $task->save();

        return $task;
    }
}
