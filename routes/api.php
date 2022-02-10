<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegistryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::group(['prefix' => 'rest'], function () {

    Route::get('/', function () {})->name('/');
    Route::get('/unauthorized', function () {
        return response()->json(null, 401);
    })->name('/unauthorized');

    /* Login e Registration */
    Route::post('login', [PassportAuthController::class, 'login']);
    Route::post('register', [PassportAuthController::class, 'register']);

    /* Products */
    Route::get('/products', [ProductController::class, 'showFiltered']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::get('/product', [ProductController::class, 'showByIds']);

    Route::get('/categories', [CategoryController::class, 'showAll']);
    Route::get('/category/{name}', [CategoryController::class, 'showByName']);

    Route::get('/banners', [BannerController::class, 'showAll']);

    /* AUTH */
    Route::group(['middleware' => ['auth:api']], function() {
        /* User */
        Route::get('/user/{id}', [UserController::class, 'show']);

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
            Route::patch('/user/{id}', [UserController::class, 'updateRole']);

            /* Orders */
            Route::get('/orders', [OrderController::class, 'showAll']);

            /* Category */
            Route::post('/category', [CategoryController::class, 'create']);
            Route::patch('/category/{id}', [CategoryController::class, 'update']);
            Route::delete('/category/{id}', [CategoryController::class, 'delete']);

            /* Banner */
            Route::post('/banner', [BannerController::class, 'create']);
            Route::get('/banner/{name}', [BannerController::class, 'showByName']);
            Route::post('/banner/{id}', [BannerController::class, 'update']);
            Route::delete('/banner/{id}', [BannerController::class, 'delete']);

        });
    });
});


