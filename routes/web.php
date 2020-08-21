<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


$matching = new \App\Components\MatchMaking(\App\Models\Order::find(4));
$results = $matching->find();

dd($results);



Route::get('/', function () {
    return view('welcome');
});
