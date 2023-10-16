<?php

namespace App\Enum;

enum TelegramCommands:string {
    case start = 'start';
    case stop = 'stop';
    case tasks = 'tasks';
}
