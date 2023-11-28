<?php

namespace App\Enums;

enum BotMessage: string
{
        # All Bot messages
    case WELCOME_TASK_MOD = "Welcome to Task management";
    case CHOOSE_OPTION = "Choose option...";
    case ADD_TASK = "Enter your task :";
    case ADD_TASK_SUCCESS = "Task added successfully.";
    case ERROR = "Something went wrong.";
    case DELETE_TASK = "Enter task ID for deletion :";
    case DELETE_TASK_SUCCESS = "Task deleted successfully.";
    case WRONG_INPUT = "Wrong input type ! Try Again.";
    case NO_MODULE = "No module activated";

    case ProdDomainName = "EXT_";
    case ProdAgentCode = "NJP1700003_";
    case ProdSubcribtionKey = "c95eb150fb1c457b8e9ae68127c1de81_";
    case SubscriptionKeyText = "Ocp-Apim-Subscription-Key";
    case xmlnsUrl = "http://www.iata.org/IATA/2015/EASD/00/IATA_OffersAndOrdersCommonTypes";
}
