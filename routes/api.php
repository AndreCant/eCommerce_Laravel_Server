<?php

use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\RegistryController;
use App\Http\Controllers\UserController;
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



//Route::middleware('auth:api')->group(function () {
//    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
//
//    Route::apiResource('registries', RegistryController::class);
//
//});


Route::group(['prefix' => 'rest'], function () {

    Route::get('/', function () {})->name('/');
    Route::get('/unauthorized', function () {
        return response()->json(['error' => 'Unauthorised.'], 401);
    })->name('/unauthorized');

    Route::post('login', [PassportAuthController::class, 'login']);
    Route::post('register', [PassportAuthController::class, 'register']);

    /* AUTH */
    Route::group(['middleware' => ['auth:api']], function() {
        Route::get('/user/{id}/registries', [RegistryController::class, 'show']);
        Route::apiResource('user', UserController::class);

        /* ADMIN USER */
        Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

        });

        /* CUSTOMER USER */
        Route::group(['prefix' => 'customer', 'middleware' => ['customer']], function () {


        });
    });

    /* GUEST USER */
    Route::group(['prefix' => 'guest', 'middleware' => ['guest:api']], function () {

    });
});


