<?php

namespace App\Service\Callbacks;

use App\Models\TeleUser;
use Telegram\Bot\Laravel\Facades\Telegram;

class TaskCallbackHandler {
     public function handle($action , $userID){
        $this->{$action}($userID);
    }

    private function taskadd($userID){

        $userObj = TeleUser::findTeleUserByClientId($userID);
        if($userObj){
            Telegram::sendMessage([
                'chat_id' => $userID,
                'text' => "Enter you task",
            ]);
            $userObj->state =  'task-add';
            $userObj->save();
        }else{
            Telegram::sendMessage([
                'chat_id' => $userID,
                'text' => "Something went wrong try again",
            ]);
        }

    }
    private function taskdelete(){

    }
    private function taskedit(){

    }
    private function taskview(){

    }
}
