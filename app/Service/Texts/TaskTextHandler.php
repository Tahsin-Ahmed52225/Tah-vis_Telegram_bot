<?php

namespace App\Service\Texts;

use App\Models\Task;
use App\Models\TeleUser;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TaskTextHandler {
     public function handle($action , $update){
        $Func = str_replace("-","",$action->state);
        $this->{$Func}($action->id , $update);
    }

    private function taskadd($id,$update){

        $task = Task::store($id, $update->message->text);
        if($task){
            Telegram::sendMessage([
                'chat_id' => $update->message->from->id,
                'text' => "Task Added Successfully.",
            ]);

        }else{ 
            Telegram::sendMessage([
                'chat_id' => $update->message->from->id,
                'text' => "Something went wrong.",
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
