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

Route::POST("user-signup", "UserController@userSignUp");
Route::POST("user-login", "UserController@userLogin");
Route::GET("user/{email}", "UserController@userDetail");

Route::GET("series", "SeriesController@list");
Route::POST('series', 'SeriesController@store');
Route::POST('series/{id}', 'SeriesController@update');
Route::DELETE('series/{id}', 'SeriesController@delete');

Route::GET("platforms", "PlatformController@list");
Route::POST('platforms', 'PlatformController@store');
Route::POST('platforms/{id}', 'PlatformController@update');
Route::DELETE('platforms/{id}', 'PlatformController@delete');

Route::GET('series-history', 'SeriesHistoryController@list');
Route::POST('series-history', 'SeriesHistoryController@store');
Route::POST('series-history/{id}', 'SeriesHistoryController@update');
Route::DELETE('series-history/{id}', 'SeriesHistoryController@delete');
