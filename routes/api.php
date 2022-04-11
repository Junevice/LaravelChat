<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\GroupController;

use App\Http\Controllers\SocialController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::apiResource('messages', MessageController::class);
    Route::apiResource('groups', GroupController::class);
    Route::apiResource('users', UserController::class);
// });


Route::get('userinfos', [SocialController::class, 'getinfos'] );