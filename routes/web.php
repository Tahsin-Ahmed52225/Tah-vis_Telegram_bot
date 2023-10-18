<?php

use App\Http\Controllers\TelegramBotController;
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

    // Commands handler method returns the Update object.
    // So you can further process $update object
    // to however you want.
});

# Ticktick API routes
Route::get('/ticktick-auth', [TelegramBotController::class, 'updatedActivity']);

