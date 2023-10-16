<?php

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
    return view('welcome');
});

# Telegram bot routes

Route::get('/updated-activity', [TelegramBotController::class, 'updatedActivity']);
Route::post('/send-message', [TelegramBotController::class, 'storeMessage']);
Route::post('/bot-update', [TelegramBotController::class, 'botUpdate'])->name('update');

# Ticktick API routes
Route::get('/ticktick-auth', [TelegramBotController::class, 'updatedActivity']);

