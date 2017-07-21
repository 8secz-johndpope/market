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

Route::get('/', 'MarketController@index');
Route::get('/user/leaves','MarketController@leaves');
Route::get('user/{id}', 'MarketController@show');
Route::get('/{any}', 'MarketController@search');
