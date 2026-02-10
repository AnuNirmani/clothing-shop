<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
    // Latest Items API
    Route::get('/items/latest', [App\Http\Controllers\Api\ItemController::class, 'getLatestItem']);
    Route::get('/items/latest-womens', [App\Http\Controllers\Api\ItemController::class, 'getLatestWomensItem']);
    Route::get('/items/latest-mens', [App\Http\Controllers\Api\ItemController::class, 'getLatestMensItem']);
    Route::get('/items/latest-four', [App\Http\Controllers\Api\ItemController::class, 'getLatestFourItems']);
});
