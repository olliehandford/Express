<?php

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');


Route::group(['middleware' => 'auth'], function() {
    // Handle discord authentication routes
    Route::get('/discord', 'DiscordController@index');
    Route::get('/discord/join', 'DiscordController@join');
    Route::get('/discord/handler', 'DiscordController@handleJoin');

    // Handle account authentication routes
    Route::get('/account', 'AccountController@index');
});


Route::group(['middleware' => 'auth.admin'], function() {
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/search', 'AdminController@search');
    Route::get('/admin/keys/{key}', 'AdminController@keys');
});

