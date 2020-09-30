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
//    Route::resource('funeral-homes', 'FuneralHomeController')->only('index', 'show', 'store', 'update', 'destroy');
    Route::resource('services', 'ServiceController')->only('index', 'show', 'store', 'update', 'destroy');
    Route::resource('orders', 'OrderController')->only('index', 'show', 'store', 'update', 'destroy');
    Route::resource('media', 'MediaController')->only('index', 'show', 'store', 'update', 'destroy');


    Route::get('/cemetery-types', function (){
        return \App\Models\Cemetery::TYPES;
    });
    Route::get('/cemetery-classifications', function (){
        return \App\Models\Classification::all();
    });
    Route::get('/entities', function (){
        return config('entities');
    });
    Route::get('/permissions', function (){
        return \App\Models\Permission::all();
    });
    Route::get('/input-types', function (){
        return config('inputs');
    });

    Route::get('/transaction-types', function (){
        return config('transactions');
    });

    Route::get('/orders/{order}/matching', 'OrderMatchingController');

    Route::prefix('funeral-homes')->group(function () {
        Route::get('/', 'FuneralHomeController@index');
        Route::get('/{home}', 'FuneralHomeController@show');
        Route::put('/{home}', 'FuneralHomeController@update');
        Route::delete('/{home}', 'FuneralHomeController@update');
        Route::post('/', 'FuneralHomeController@store');
    });

    Route::resource('organizations', 'Admin\ManagerController')->only('index','show','update', 'destroy');
    Route::resource('users', 'UserController')->only('show','update', 'destroy');
    Route::resource('managers', 'ManagerController')->only('index','show','update', 'destroy');



    Route::prefix('admin')->group(function () {
        //->middleware('auth:api-admins')
        Route::prefix('funeral-homes')->group(function () {
            Route::get('/', 'FuneralHomeController@index');
            Route::get('/{home}', 'FuneralHomeController@show');
            Route::put('/{home}', 'FuneralHomeController@update');
            Route::delete('/{home}', 'FuneralHomeController@update');
            Route::post('/', 'FuneralHomeController@store');
            Route::resource('users', 'Admin/UserController')->only('index', 'show', 'store', 'update', 'destroy');
        });

        Route::resource('organizations', 'Admin\ManagerController')->only('index','show','update', 'destroy');
        Route::resource('users', 'Admin\UserController')->only('index', 'show', 'store', 'update', 'destroy');
        Route::resource('managers', 'Admin\ManagerController')->only('index','show','update', 'destroy');
        Route::resource('cemeteries', 'CemeteryController')->only('index', 'show', 'store', 'update', 'destroy');
        Route::resource('laboratories', 'LaboratoryController')->only('index', 'show', 'store', 'update', 'destroy');
        Route::resource('cremations', 'CremationController')->only('index', 'show', 'store', 'update', 'destroy');
        Route::resource('services', 'Admin\ServiceController')->only('index', 'show', 'store', 'update', 'destroy');
        Route::resource('transactions', 'Admin\TransactionController')->only('index','store','show','update', 'destroy');
    });

Route::get('/permissions', function (){
    return \App\Models\Permission::all();
});
 
