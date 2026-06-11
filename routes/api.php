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
    Route::get('/items/offered', [App\Http\Controllers\Api\ItemController::class, 'getOfferedItems']);
    Route::get('/home/hero-image', [App\Http\Controllers\Api\ItemController::class, 'getHomeHeroImage']);
    Route::get('/home/hero-buttons', [App\Http\Controllers\Api\ItemController::class, 'getHomeHeroButtons']);
    Route::get('/home/stores', [App\Http\Controllers\Api\ItemController::class, 'getHomeStores']);
    Route::get('/types/latest-items', [App\Http\Controllers\Api\ItemController::class, 'getTypesWithLatestItem']);
    Route::get('/items', [App\Http\Controllers\Api\ItemController::class, 'getItems']);
    Route::get('/items/{id}', [App\Http\Controllers\Api\ItemController::class, 'getItemById']);
    Route::get('/categories/{id}/types', [App\Http\Controllers\Api\ItemController::class, 'getTypesByCategory']);
    Route::get('/categories-with-types', [App\Http\Controllers\Api\ItemController::class, 'getCategoriesWithTypes']);

    // Orders API
    Route::post('/orders', [App\Http\Controllers\Api\OrderController::class, 'store']);
});
