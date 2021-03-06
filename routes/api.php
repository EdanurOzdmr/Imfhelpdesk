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
    'prefix' => 'v1'
], function () {
    Route::post('user-login', 'Api\AuthController@userLogin');
    Route::post('user-register', 'Api\AuthController@userRegister');
    Route::post('staff-login', 'Api\AuthController@staffLogin');
    Route::post('staff-register', 'Api\AuthController@staffRegister');
});


Route::group([
    'prefix' => 'v1'
], function () {
    Route::post('demand', 'Api\DemandController@store')->middleware('auth:users');
    Route::put('demand-update/{id}', 'Api\DemandController@update')->middleware('auth:users');
    Route::get('demand-show','Api\DemandController@demandShow')->middleware('auth:staff-api');
    Route::post('demand-response','Api\DemandController@demandResponse')->middleware('auth:staff-api');
});
