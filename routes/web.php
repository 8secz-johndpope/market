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
Route::get('/loc', 'MarketController@loc');
Route::get('/locs', 'MarketController@locs');
Route::get('/wrong', 'MarketController@wrong');
Route::get('/searchform', 'MarketController@searchform');
Route::get('/messages', 'MessageController@test');

Route::post('/hellosign', 'MarketController@hellosign');

Route::get('/update', 'MarketController@update');
Route::get('/updates', 'MarketController@updates');

Route::get('/insert', 'MarketController@insert');
Route::get('/user/ads/post', 'HomeController@post');
Route::post('/user/advert/newad', 'HomeController@newad');
Route::get('/user/manage/ads', 'HomeController@myads');
Route::get('/user/manage/favorites', 'HomeController@favorites');
Route::post('/user/cards/add', 'HomeController@addcard');
Route::get('/user/manage/order', 'HomeController@order');
Route::get('/user/address/change/{id}', 'HomeController@change');
Route::get('/user/manage/order/shipping/update/{id}', 'HomeController@update_shipping');
Route::get('/user/generate/pdf', 'HomeController@pdf');


Route::get('/business/manage/ads', 'BusinessController@myads');
Route::get('/business/manage/finance', 'BusinessController@finance');
Route::post('/business/manage/bump', 'BusinessController@bump');

Route::get('/business/invoice/pay/{id}', 'BusinessController@invoice');


Route::get('/user/manage/orders', 'HomeController@orders');
Route::get('/user/manage/buying', 'HomeController@buying');
Route::get('/user/manage/messages', 'HomeController@messages');
Route::get('/user/manage/details', 'HomeController@details');

Route::get('/user/manage/shipping/{id}', 'HomeController@shipping');

Route::get('/user/contract/pricing', 'HomeController@pricing');
Route::get('/user/contract/business/{id}', 'HomeController@business');
Route::get('/user/contract/cbusiness', 'HomeController@cbusiness');

Route::get('/user/contract/start', 'HomeController@contract');
Route::get('/user/contract/sign', 'HomeController@sign');
Route::get('/user/contract/pack/delete/{id}', 'HomeController@delete_pack');

Route::get('/user/contract/pack/{category}/{location}', 'HomeController@pack');
Route::get('/user/contract/packs', 'HomeController@packs');


Route::post('/user/payment/stripe', 'HomeController@stripe');
Route::get('/user/payment/paypal', 'HomeController@paypal');

Route::get('/user/email/verify', 'HomeController@verify');
Route::post('/user/list/favorite','UserController@favorite')->middleware('auth');
Route::post('/user/list/unfavorite','UserController@unfavorite')->middleware('auth');
Route::get('/user/list/price','UserController@price')->middleware('auth');

Route::get('/user/advert/delete/{id}', 'HomeController@delete');

Route::get('/user/p/stats/{id}', 'HomeController@stats');


Route::get('/category/children/{id}', 'HomeController@children');
Route::get('/location/children/{id}', 'HomeController@lchildren');
Route::get('/postcodes/postcode', 'HomeController@postcode');

Route::get('/category/extras/{id}', 'HomeController@extras');
Route::get('/category/prices/{id}', 'HomeController@prices');
Route::get('/category/price/{id}', 'HomeController@price');

Route::get('/category/total/{id}', 'HomeController@total');


Route::get('/category/suggest', 'HomeController@suggest');
Route::get('/category/string/{id}', 'HomeController@string');
Route::get('/location/string/{id}', 'HomeController@lstring');

Route::get('/fields/{any}', 'MarketController@fields');
Route::get('/filters/{any}', 'MarketController@filters');

Route::get('/id/{id}', 'MarketController@id');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Auth::routes();

Route::get('/jobscats', 'MarketController@jobscats');
Route::get('/notfound', 'MarketController@notfound');

Route::get('/', 'MarketController@index');
Route::get('/user/leaves','MarketController@leaves');

Route::get('/p/{cat}/{id}', 'MarketController@product');

Route::get('/{any}', 'MarketController@search');
Route::get('/{any}/{loc}', 'MarketController@lsearch');
Route::namespace('Admin')->group(function () {
    Route::get('/admin/manage/pricegroup/add', 'AdminController@add_pricegroup')->middleware('admin');
    Route::get('/admin/manage/packs', 'AdminController@packs')->middleware('admin');
    Route::get('/admin/manage/pricegroup', 'AdminController@pricegroup')->middleware('admin');
    Route::get('/admin/manage/role', 'AdminController@iam')->middleware('admin');
});