<?php

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

Route::group(['middleware' => ['auth:api', 'auth:adminapi']], function () {
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [\App\Http\Controllers\ProductController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\ProductController::class, 'create']);
    });    
});

Route::group(['prefix' => 'user'], function () {
    Route::post('register/', [\App\Http\Controllers\Auth\AuthController::class, 'register']);
    Route::post('login/', [\App\Http\Controllers\Auth\AuthController::class, 'login']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::post('register/', [\App\Http\Controllers\Auth\AdminAuthController::class, 'register']);
    Route::post('login/', [\App\Http\Controllers\Auth\AdminAuthController::class, 'login']);
});
