<?php

use App\Http\Controllers\AdminTicketController;
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


Route::group([
    'middleware' => ['auth:sanctum'],
], function () {
    Route::post('/tickets', [TicketController::class, 'store']);
    Route::get('/tickets', [TicketController::class, 'index']);
    Route::get('/tickets/{id}', [TicketController::class, 'show']);
});

Route::group([
    'middleware' => ['auth:sanctum', 'role:admin'],
    'prefix' => 'admin'
], function () {
    Route::get('/tickets', [AdminTicketController::class, 'index']);
    Route::post('/tickets/{id}/messages', [AdminTicketController::class, 'storeMessage']);
    Route::patch('/tickets/{id}', [AdminTicketController::class, 'update']);
});

