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
Route::get('/ufields', 'MarketController@ufields');

Route::get('/update', 'MarketController@update');
Route::get('/insert', 'MarketController@insert');
Route::get('/user/ads/post', 'HomeController@post');
Route::post('/user/advert/newad', 'HomeController@newad');
Route::get('/user/manage/ads', 'HomeController@myads');
Route::get('/user/manage/favorites', 'HomeController@favorites');
Route::post('/user/cards/add', 'HomeController@addcard');
Route::get('/user/manage/order', 'HomeController@order');

Route::get('/user/manage/shipping', 'HomeController@shipping');


Route::post('/user/payment/stripe', 'HomeController@stripe');
Route::get('/user/payment/paypal', 'HomeController@paypal');

Route::get('/user/email/verify', 'HomeController@verify');
Route::post('/user/list/favorite','UserController@favorite')->middleware('auth');
Route::post('/user/list/unfavorite','UserController@unfavorite')->middleware('auth');
Route::get('/user/list/price','UserController@price')->middleware('auth');

Route::get('/user/advert/delete/{id}', 'HomeController@delete');

Route::get('/category/children/{id}', 'HomeController@children');
Route::get('/category/extras/{id}', 'HomeController@extras');
Route::get('/category/prices/{id}', 'HomeController@prices');
Route::get('/category/price/{id}', 'HomeController@price');

Route::get('/category/suggest', 'HomeController@suggest');
Route::get('/category/string/{id}', 'HomeController@string');

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
