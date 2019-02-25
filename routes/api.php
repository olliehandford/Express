<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'auth:api'], function() {
    // User updating controller
    Route::get('/user', 'UserAPIController@show');
    Route::put('/user', 'UserAPIController@update');

    // Discord API
    Route::get('/discord', 'DiscordAPIController@index');
    Route::delete('/discord', 'DiscordAPIController@unlink');

});


Route::group(['middleware' => ['auth.admin', 'auth:api']], function() {
    Route::get('/admin/search/{search}', 'SearchAPIController@search');
});


