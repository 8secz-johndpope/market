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
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/', 'MarketController@index');
Route::get('/p/{cat}/{id}', 'MarketController@product');
Route::get('/user/leaves','MarketController@leaves');
Route::get('/login', 'UserController@login');
Route::get('/register', 'UserController@register');
Route::post('/user/advert/create','UserController@create');
Route::get('/{any}', 'MarketController@search');
Route::get('/user/profile', 'UserController@profile')->middleware('auth:api');
Auth::routes();

