<?php

use App\Http\Controllers\TelegramBotController;
use App\Service\CommonService;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

# Telegram bot routes
Route::post('/webhook', function () {
    $update = Telegram::commandsHandler(true);
   # handles if it isn't a bot command
   if(!isset($update->entiites)){
    return CommonService::handle($update);
   }
    return $update;
});

# Ticktick API routes
Route::get('/ticktick-auth', [TelegramBotController::class, 'updatedActivity']);

