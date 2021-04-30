<?php

use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\RegistryController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

//Route::middleware('auth:api')->group(function () {
//    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
//
//    Route::apiResource('registries', RegistryController::class);
//
//});

Route::group(['prefix' => 'guest', 'middleware' => ['guest:api']], function () {

});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:api', 'admin']], function () {
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);

    Route::apiResource('registries', RegistryController::class);
});

Route::group(['prefix' => 'customer', 'middleware' => ['auth:api', 'customer']], function () {
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);

    Route::apiResource('registries', RegistryController::class);
});
