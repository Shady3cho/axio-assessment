<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'website'], function () {
    Route::post('public', [WebsiteController::class, 'addWebsite']);
    Route::post('{id}/add-post', [WebsiteController::class, 'addPost']);
});

Route::group(['prefix' => 'user'], function () {
    Route::post('', [UserController::class, 'addUser']);
    Route::post('{id}/subscribe', [UserController::class, 'subscribe']);
});

Route::post('test', [UserController::class, 'test']);

