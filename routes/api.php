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
Route::get('/error','MarketController@error');

Route::get('/advert/category/fields/{any}','MarketController@fields');

Route::post('/user/login', 'UserController@login');
Route::get('/user/adverts', 'UserController@adverts')->middleware(['auth:api','myown']);

Route::post('/user/register', 'UserController@register');
Route::post('/user/advert/create','UserController@create')->middleware('auth:api');
Route::post('/user/advert/ccreate','UserController@ccreate');

Route::get('/user/profile', 'UserController@profile')->middleware('auth:api');


Route::middleware(['auth:api','myown'])->get('/check',function(Request $request) {
    return 'came here';
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
