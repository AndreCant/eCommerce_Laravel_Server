<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegistryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
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
        return response()->json(['error' => 'Unauthorized.'], 401);
    })->name('/unauthorized');

    /* Login e Registration */
    Route::post('login', [PassportAuthController::class, 'login']);
    Route::post('register', [PassportAuthController::class, 'register']);

    /* Products */
    Route::get('/products', [ProductController::class, 'showFiltered']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::get('/product', [ProductController::class, 'showByIds']);

    /* AUTH */
    Route::group(['middleware' => ['auth:api']], function() {
        Route::apiResource('user', UserController::class);

        /* Registry */
        Route::get('/user/{id}/registry', [RegistryController::class, 'show']);
        Route::patch('/user/{id}/registry', [RegistryController::class, 'update']);

        /* Payments */
        Route::get('/user/{id}/payment', [PaymentController::class, 'showAll']);
        Route::post('/user/{id}/payment', [PaymentController::class, 'create']);
        Route::delete('/user/{id}/payment/{paymentId}', [PaymentController::class, 'delete']);

        /* Orders */
        Route::get('/user/{id}/orders', [OrderController::class, 'showByUser']);
        Route::post('/user/{id}/order', [OrderController::class, 'create']);

        /* ADMIN USER */
        Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
            /* Product */
            Route::post('/product', [ProductController::class, 'store']);
            Route::patch('/product/{id}', [ProductController::class, 'update']);
            Route::delete('/product/{id}', [ProductController::class, 'delete']);

            /* Images */
            Route::post('/image', [ImageController::class, 'store']);
            Route::delete('/image/{id}', [ImageController::class, 'delete']);

            /* Users */
            Route::get('/users', [UserController::class, 'showAll']);

            /* Orders */
            Route::get('/orders', [OrderController::class, 'showAll']);
        });

        /* CUSTOMER USER */
        Route::group(['prefix' => 'customer', 'middleware' => ['customer']], function () {


        });
    });

    /* GUEST USER */
    Route::group(['prefix' => 'guest', 'middleware' => ['guest:api']], function () {

    });
});


