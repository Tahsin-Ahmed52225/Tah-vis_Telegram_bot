<?php

namespace App\Service\Callbacks;

class CallbackHandler {
    static public function handle($update){
        // Need to handle the state
        $moduleName = explode('-',$update->callback_query->data);
        switch($moduleName[0]){
            case 'task':  $handlerObj = new TaskCallbackHandler; break;
        }
        $handlerObj->handle($moduleName[0].$moduleName[1] , $update->callback_query->from->id);
    }
}
