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

Route::get('/api/advert/categories','MarketController@categories');
Route::get('/api/error','MarketController@error');

Route::get('/api/advert/category/fields/{any}','MarketController@fields');

Route::post('/api/user/login', 'UserController@login');
Route::get('/api/user/adverts', 'UserController@adverts');

Route::post('/api/user/register', 'UserController@register');
Route::post('/api/user/advert/create','UserController@create')->middleware('auth:api');
Route::post('/api/user/advert/ccreate','UserController@ccreate');

Route::get('/api/user/profile', 'UserController@profile')->middleware('auth:api');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
