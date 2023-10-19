<?php

namespace App\Telegram\Commands;

use App\Models\TeleUser;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Start Command to get you started';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => $this->teleUserManagement($this->getUpdate()),
        ]);
        # Get all the registered commands.
        $commands = $this->getTelegram()->getCommands();

        $response = '';
        foreach ($commands as $name => $command) {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }
        $this->replyWithMessage([
            'text' =>  $response,
        ]);
    }

    private function teleUserManagement($request){
        $clientID = $request['message']['from']['id'];
        $user = TeleUser::findTeleUserByClientId($clientID);
        if(count($user) != 0){
            return "Welcome back ".$request['message']['from']['first_name'];

        }else{
            TeleUser::store($request['message']['from']);
            return "Hello ".$request['message']['from']['first_name']. " How can I help you?";

        }
    }
}
