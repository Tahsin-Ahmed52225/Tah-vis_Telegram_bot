<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\TelegramBotController;
use Illuminate\Support\Facades\Route;

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
    return view('app');
});

# Telegram bot routes
Route::post('/webhook', [BotController::class, 'botHandler']);
# Task webview routes
Route::get('/view-tasks', [BotController::class, 'botHandler']);

# Ticktick API routes
Route::get('/ticktick-auth', [TelegramBotController::class, 'updatedActivity']);

