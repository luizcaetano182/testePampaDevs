<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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
    'prefix' => 'person'
], function(){
	Route::get('/','App\Http\Controllers\PersonController@index');
    Route::get('/{id}', 'App\Http\Controllers\PersonController@get');
	Route::delete('/{id}', 'App\Http\Controllers\PersonController@delete');
	Route::put('/{id}', 'App\Http\Controllers\PersonController@update');
});

Route::group([
    'prefix' => 'planet'
], function(){
	Route::get('/','App\Http\Controllers\PlanetController@index');
    Route::get('/{id}', 'App\Http\Controllers\PlanetController@get');
	Route::delete('/{id}', 'App\Http\Controllers\PlanetController@delete');
	Route::put('/{id}', 'App\Http\Controllers\PlanetController@update');
});

Route::group([
    'prefix' => 'starship'
], function(){
	Route::get('/','App\Http\Controllers\StarshipController@index');
    Route::get('/{id}', 'App\Http\Controllers\StarshipController@get');
	Route::delete('/{id}', 'App\Http\Controllers\StarshipController@delete');
	Route::put('/{id}', 'App\Http\Controllers\StarshipController@update');
});