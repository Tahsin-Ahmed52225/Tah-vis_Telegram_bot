<?php

namespace App\Service\WebView;

use App\Models\TeleUser;

class TaskManager {
    private $activeUserID;

    public function __construct($userID) {
        $this->activeUserID = $userID;
    }

    public function getTasksForWebApp(){
        $user =  TeleUser::with('task')->where('client_id', $this->activeUserID)->get();
        return $user->task;
        // $user = TeleUser::findTeleUserByClientId($this->activeUserID);
        //  dd($user->task());
        // return $user->task();
    }

}
