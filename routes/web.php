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

Route::get('/dashboard', 'PagesController@dashboard');


Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@index')->name('home');
Route::get('/about', 'PagesController@about');

Route::post('/restock', 'RestockController@enterWithPassword')->name('restock');

Route::group(['prefix' => 'buy', 'middleware' => 'restock'], function() {
    Route::get('/', ['uses' => 'BuyController@index', 'as' => 'buy']);
    Route::post('/', ['uses' => 'BuyController@buyWithAccount', 'as' => 'buy-withaccount']);
    Route::post('/without', ['uses' => 'BuyController@buyWithoutAccount', 'as' => 'buy-withoutaccount']);
});

Route::group(['middleware' => 'auth'], function() {
    // Handle discord authentication routes
    Route::get('/discord', 'DiscordController@index');
    Route::get('/discord/join', 'DiscordController@join');
    Route::get('/discord/handler', 'DiscordController@handleJoin');

    Route::group(['prefix' => 'account'], function () {
        // Handle account authentication routes
        Route::get('/', 'AccountController@index')->name('account');
        Route::get('/cancel', 'AccountController@cancelSubscription')->name('buy-cancel');
        Route::get('/resume', 'AccountController@resumeSubscription')->name('buy-resume');
    });
});


Route::group(['middleware' => 'auth.admin'], function() {
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/search', 'AdminController@search');
    Route::get('/admin/keys/{key}', 'AdminController@keys');
});

