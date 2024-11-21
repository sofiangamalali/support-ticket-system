<?php

use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::group([
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/tickets', [TicketController::class, 'index']);
    Route::post('/tickets', [TicketController::class, 'store']);
    Route::get('/tickets/{ticket}', [TicketController::class, 'show']);
});

Route::group([
    'middleware' => ['auth:sanctum'],
    'prefix' => 'admin'
], function () {
    Route::get('/tickets', [AdminTicketController::class, 'index']);
    Route::post('/tickets/{ticket}/messages', [AdminTicketController::class, 'storeMessage']);
    Route::patch('/tickets/{ticket}', [AdminTicketController::class, 'update']);
});

