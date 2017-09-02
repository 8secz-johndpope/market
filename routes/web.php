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
Route::get('/dummy', 'MarketController@dummy');
Route::get('/pull', 'MarketController@pull');
Route::get('/update', 'MarketController@update');
Route::get('/insert', 'MarketController@insert');
Route::get('/post', 'HomeController@post');
Route::get('/children/{id}', 'HomeController@children');

Route::get('/fields/{any}', 'MarketController@fields');
Route::get('/filters/{any}', 'MarketController@filters');

Route::get('/id/{id}', 'MarketController@id');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Auth::routes();

Route::get('/jobscats', 'MarketController@jobscats');

Route::get('/', 'MarketController@index');
Route::get('/user/leaves','MarketController@leaves');

Route::get('/p/{cat}/{id}', 'MarketController@product');
Route::get('/{any}', 'MarketController@search');
