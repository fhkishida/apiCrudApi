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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware("jwt.auth")->group(function(){
    Route::apiResource('city', 'CityController');
    Route::apiResource('group', 'GroupController');
    Route::apiResource('campaign', 'CampaignController');
    Route::apiResource('product', 'ProductController');
    Route::apiResource('productValue', 'ProductValueController');
});


Route::post('login', "AuthController@login");