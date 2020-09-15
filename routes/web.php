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

Route::GET('/', 'LoginController@showLogin');


// Login
Route::GET('login', 'LoginController@showLogin')->name('login');
Route::POST('login', 'LoginController@doLogin');
Route::GET('logout', 'LoginController@doLogout')->name('logout');


Route::GET('registration', 'UserController@create')->name('registration');
Route::POST('registration', 'UserController@store')->name('user.new');

Route::group(['middleware' => ['auth', 'user']], function () {
    Route::GET('/home', 'SeriesHistoryController@list')->name('seriesHistory.list');
    Route::GET('/new', 'SeriesHistoryController@create')->name('seriesHistory.new');
    Route::POST('/new', 'SeriesHistoryController@store');
    Route::GET('edit/{id}', 'SeriesHistoryController@edit')->name('seriesHistory.edit');
    Route::POST('edit/{id}', 'SeriesHistoryController@update')->name('seriesHistory.update');
    Route::DELETE('delete/{id}', 'SeriesHistoryController@delete')->name('seriesHistory.delete');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    // Series
    Route::GET('series', 'SeriesController@list')->name('series.list');
    Route::POST('series', 'SeriesController@store')->name('series.store');
    Route::GET('series/new', 'SeriesController@create')->name('series.new');
    Route::GET('series/{id}', 'SeriesController@edit')->name('series.edit');
    Route::POST('series/{id}', 'SeriesController@update')->name('series.update');
    Route::DELETE('series/delete/{id}', 'SeriesController@delete')->name('series.delete');

    // Platform
    Route::GET('platform', 'PlatformController@list')->name('platform.list');
    Route::POST('platform', 'PlatformController@store')->name('platform.store');
    Route::GET('platform/new', 'PlatformController@create')->name('platform.new');
    Route::GET('platform/{id}', 'PlatformController@edit')->name('platform.edit');
    Route::POST('platform/{id}', 'PlatformController@update')->name('platform.update');
    Route::DELETE('platform/delete/{id}', 'PlatformController@delete')->name('platform.delete');
});
