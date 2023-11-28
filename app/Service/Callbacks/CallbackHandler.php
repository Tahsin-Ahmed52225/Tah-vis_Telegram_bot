<?php

namespace App\Service\Callbacks;

class CallbackHandler
{
    /**
     * Handling all the inline button callbacks
     * callbacks must be registered as per this [ module-stage ] example :: task-add
     * @return void
     */
    static public function handle($update)
    {
        $moduleName = explode('-', $update->callback_query->data);
        switch ($moduleName[0]) {
            case 'task':
                $handlerObj = new TaskCallbackHandler;
                break;
        }
        $handlerObj->handle($moduleName[0] . $moduleName[1], $update->callback_query->from->id);
    }
}
