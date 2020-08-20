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


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'API\AuthController@login');
    Route::post('register', 'API\AuthController@register');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'API\AuthController@logout');
        Route::get('user', 'API\AuthController@user');
    });
});
 

    Route::resource('cemeteries', 'CemeteryController')->only('index', 'show', 'store', 'update', 'destroy');
    Route::resource('laboratories', 'LaboratoryController')->only('index', 'show', 'store', 'update', 'destroy');
    Route::resource('cremations', 'CremationController')->only('index', 'show', 'store', 'update', 'destroy');
    Route::resource('funeral-home', 'FuneralHomeController')->only('index', 'show', 'store', 'update', 'destroy');
    Route::resource('services', 'ServiceController')->only('index', 'show', 'store', 'update', 'destroy');
    Route::resource('orders', 'OrderController')->only('index', 'show', 'store', 'update', 'destroy');
    Route::resource('media', 'MediaController')->only('index', 'show', 'store', 'update', 'destroy');
 

