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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Auth::routes();

Route::get('/jobscats', 'MarketController@jobscats');

Route::get('/', 'MarketController@index');
Route::get('/user/leaves','MarketController@leaves');
Route::get('/api/login', 'UserController@login');
Route::get('/api/register', 'UserController@register');
Route::post('/api/user/advert/create','UserController@create');
Route::post('/api/user/advert/ccreate','UserController@ccreate');

Route::get('/api/user/profile', 'UserController@profile')->middleware('auth:api');

Route::get('/p/{cat}/{id}', 'MarketController@product');
Route::get('/{any}', 'MarketController@search');
