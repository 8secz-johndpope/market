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

Route::get('/advert/categories','MarketController@categories');
Route::get('/advert/locations','MarketController@locations');

Route::get('/userads/{id}','UserController@userads');
Route::get('/category/price/{id}', 'HomeController@price')->middleware('auth:api');
Route::get('/postcodes/postcode','UserController@postcode');

Route::get('/advert/all-categories','MarketController@getAllCategories');
Route::get('/error','MarketController@error');
Route::get('/ads/spotlight','MarketController@spotlight');

Route::get('/advert/category/fields/{any}','MarketController@fields');

Route::post('/user/order/create', 'UserController@corder')->middleware('auth:api');
Route::post('/user/order/complete/{id}', 'UserController@complete_bump')->middleware('auth:api');

Route::post('/user/message/create', 'MessageController@fsend')->middleware('auth:api');

Route::post('/user/msg/create', 'MessageController@create_message')->middleware('auth:api');



Route::post('/user/login', 'UserController@login');
Route::middleware('auth:api')->get('/user/adverts', 'UserController@adverts');
Route::post('/user/contacts','UserController@contacts')->middleware('auth:api');

Route::post('/user/paypal/nonce','UserController@nonce')->middleware('auth:api');
Route::get('/user/paypal/token','UserController@token')->middleware('auth:api');
Route::get('/user/cards','UserController@cards')->middleware('auth:api');
Route::post('/user/cards/add','UserController@addcard')->middleware('auth:api');
Route::post('/user/card/charge','UserController@charge')->middleware('auth:api');

Route::post('/user/device/token','UserController@save_token')->middleware('auth:api');


Route::post('/user/dob/add','UserController@dob')->middleware('auth:api');
Route::post('/user/documents/identity','UserController@identity')->middleware('auth:api');
Route::post('/user/addresses/add','UserController@add_address')->middleware('auth:api');

Route::get('/user/addresses','UserController@addresses')->middleware('auth:api');
Route::post('/user/addresses/verify/{id}','UserController@verify_address')->middleware('auth:api');


Route::post('/user/bankaccounts/add','UserController@account')->middleware('auth:api');
Route::post('/user/terms/accept','UserController@terms')->middleware('auth:api');

Route::post('/user/balance/withdraw','UserController@withdraw')->middleware('auth:api');

Route::get('/user/advert/duplicate/{id}', 'UserController@duplicate')->middleware('auth:api');


Route::get('/user/account/info','UserController@info')->middleware('auth:api');
Route::get('/clients','MarketController@clients');

Route::post('/search', 'MarketController@query');

Route::post('/user/register', 'UserController@register');
Route::post('/user/advert/create','UserController@create')->middleware('auth:api');

Route::post('/user/advert/draft','UserController@save')->middleware('auth:api');

Route::post('/user/advert/update','UserController@update')->middleware('auth:api');
Route::post('/user/advert/delete','UserController@delete')->middleware('auth:api');
Route::post('/user/advert/repost','UserController@repost')->middleware('auth:api');

Route::get('/user/cvs','UserController@getcvs')->middleware('auth:api');

Route::post('/user/cvs/add','UserController@addcv')->middleware('auth:api');



Route::post('/user/covers/add','UserController@addcover')->middleware('auth:api');


Route::get('/user/advert/price','UserController@price')->middleware('auth:api');

Route::get('/user/advert/favorites','UserController@favorites')->middleware('auth:api');


Route::get('/user/alerts','UserController@alerts')->middleware('auth:api');
Route::get('/user/alert/create/{id}','UserController@alert')->middleware('auth:api');
Route::get('/user/alert/delete/{id}','UserController@delete_alert')->middleware('auth:api');
Route::get('/user/alert/toggle/{id}','UserController@toggle_alert')->middleware('auth:api');


Route::get('/user/text','UserController@text');
Route::get('/user/ctext','UserController@ctext');

Route::get('/advert/{id}','MarketController@advert')->middleware('auth:api');
Route::get('/plate', 'UserController@dvla')->middleware('auth:api');


Route::post('/user/advert/mprice','UserController@mprice')->middleware('auth:api');

Route::post('/user/advert/order','UserController@order')->middleware('auth:api');

Route::post('/user/advert/offer','UserController@offer')->middleware('auth:api');
Route::post('/user/advert/interest','UserController@interest')->middleware('auth:api');
Route::post('/user/advert/favorite','UserController@favorite')->middleware('auth:api');

Route::post('/user/advert/unfavorite','UserController@unfavorite')->middleware('auth:api');

Route::post('/user/advert/report','UserController@report')->middleware('auth:api');
Route::post('/user/order/review','UserController@review')->middleware('auth:api');

Route::post('/user/advert/apply','UserController@apply')->middleware('auth:api');


Route::post('/user/advert/ccreate','UserController@ccreate');

Route::get('/user/profile', 'UserController@profile')->middleware('auth:api');


Route::get('/user/adverts/transfer', 'UserController@transfer')->middleware('auth:api');

Route::post('/user/contract','UserController@contract')->middleware('auth:api');

Route::post('/user/advert/create/bump','UserController@bump')->middleware('auth:api');

Route::post('/user/advert/packs/buy','UserController@buy')->middleware('auth:api');

Route::post('/user/balance/topup','UserController@topup')->middleware('auth:api');
Route::get('/category/suggest','UserController@suggest');

Route::get('/stripe', 'UserController@stripe');
Route::get('/suggest','MarketController@suggest');
Route::get('/lsuggest','MarketController@lsuggest');
Route::get('/psuggest','MarketController@psuggest');
Route::get('/autosuggest','MarketController@autosuggest');

Route::get('/train','MarketController@train');

Route::get('/{any}','MarketController@error');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
