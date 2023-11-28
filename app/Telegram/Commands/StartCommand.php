<?php

namespace App\Telegram\Commands;

use App\Models\TeleUser;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Start Command to get you started';

    /**
     * Handle when start command is called
     */
    public function handle(): void
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

    /**
     * Stores or check User info after start command and generate welcome message
     */
    private function teleUserManagement(mixed $request): string
    {
        $clientID = $request['message']['from']['id'];
        $user = TeleUser::findTeleUserByClientId($clientID);
        if ($user) {
            TeleUser::where(['client_id' => $user->client_id])->update(['state' => '']);
            return "Welcome back " . $request['message']['from']['first_name'];
        } else {
            $user = TeleUser::store($request['message']['from']);
            return "Hello " . $request['message']['from']['first_name'] . " How can I help you?";
        }
        TeleUser::where(['client_id' => $user->client_id])->update(['state' => '']);
    }
}
