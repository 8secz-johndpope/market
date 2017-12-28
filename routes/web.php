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
Route::get('/gads', 'MarketController@gads');
Route::get('/parse', 'CronController@parse_page');
Route::get('/indeed', 'CronController@indeed');
Route::get('/gitpull', 'MarketController@gitpull');
Route::get('/more/{id}', 'MarketController@more');

Route::get('/plate', 'HomeController@dvla');
Route::get('/push', 'HomeController@push');

Route::get('/allfields', 'MarketController@allfields');

Route::get('/ast/{p}/{q}', 'MarketController@ast');

Route::post('/hellosign', 'MarketController@hellosign');

Route::get('/update', 'MarketController@update');
Route::get('/updates', 'MarketController@updates');

Route::get('/insert', 'MarketController@insert');
Route::get('/user/ads/post', 'HomeController@post');
Route::post('/user/advert/location', 'HomeController@location');
Route::post('/user/advert/newad', 'HomeController@newad');
Route::get('/user/manage/ads', 'BusinessController@myads');
Route::get('/user/manage/images', 'BusinessController@images');
Route::get('/user/image/add', 'BusinessController@image');
Route::get('/user/ad/multi/create','BusinessController@multiple');
Route::post('/user/ad/images', 'BusinessController@add_images');
Route::get('/user/p/deliver/{id}', 'MarketController@can_deliver');
Route::get('/user/cvs/add', 'HomeController@add_cv');
Route::get('/user/manage/contacts', 'HomeController@contacts');
Route::get('/user/manage/invoices', 'HomeController@invoices');

Route::get('/user/contacts/add', 'HomeController@add_contact');
Route::get('/user/groups/create', 'HomeController@create_group');
Route::get('/user/new/broadcast', 'HomeController@create_broadcast');
Route::get('/user/edit/profile', 'HomeController@edit_profile');
Route::get('/user/new/message', 'HomeController@new_message');

Route::get('/user/transfer/balance/{id}', 'HomeController@transfer_balance');


Route::post('/user/save/profile', 'HomeController@save_pro');

Route::post('/user/groups/add', 'MessageController@add_group');
Route::post('/user/send/broadcast', 'MessageController@send_broadcast');

Route::get('/user/direct/message/{id}', 'MessageController@direct_message');
Route::get('/user/direct/invoice/{id}', 'MessageController@direct_invoice');

Route::post('/user/contact/add', 'HomeController@adds_contact');

Route::get('/user/category/auto/{id}/{count}', 'BusinessController@auto');

Route::post('/user/upload/csv', 'BusinessController@csv');

Route::post('/user/advert/category/change', 'HomeController@change_category');
Route::post('/user/advert/location/change', 'HomeController@change_location');


Route::get('/user/ad/create', 'HomeController@create');

Route::get('/room/invoice/create/{id}', 'HomeController@create_invoice');
Route::post('/room/invoice/save', 'HomeController@save_invoice');


Route::get('/user/manage/ad/{id}', 'HomeController@manage');

Route::get('/userads/{id}', 'MarketController@userads');

Route::get('/user/manage/messages', 'MessageController@messages');
Route::get('/user/manage/messages/{rid}', 'MessageController@gmessages');
Route::get('/user/manage/rooms/{id}/{ch}', 'MessageController@rooms');
Route::get('/user/manage/msgs/{id}', 'MessageController@msgs');

Route::get('/user/message/push','MessageController@push');

Route::get('/user/message/send','MessageController@send');


Route::post('/user/message/send','MessageController@send');
Route::post('/user/message/asend','MessageController@asend');

Route::post('/user/message/bsend','MessageController@bsend');

Route::post('/user/message/rsend','MessageController@rsend');

Route::get('/user/manage/favorites', 'HomeController@favorites');
Route::get('/user/manage/alerts', 'HomeController@alerts');
Route::get('/user/manage/applications', 'HomeController@applications');
Route::get('/user/manage/motors', 'HomeController@motors');
Route::get('/user/manage/sales', 'HomeController@motors');
Route::get('/job/manage/applications/{id}', 'HomeController@view_applications');

Route::get('/user/create/alert/{id}', 'HomeController@alert');
Route::get('/user/delete/alert/{id}', 'HomeController@delete_alert');
Route::get('/user/toggle/alert/{id}', 'HomeController@toggle_alert');

Route::get('/user/delete/address/{id}', 'HomeController@delete_address');
Route::get('/user/delete/cv/{id}', 'HomeController@delete_cv');
Route::get('/user/delete/cover/{id}', 'HomeController@delete_cover');

Route::get('/user/primary/address/{id}', 'HomeController@primary_address');


Route::post('/user/cards/add', 'HomeController@addcard');
Route::post('/user/accounts/add', 'HomeController@add_bank_account');
Route::post('/user/addresses/add', 'HomeController@add_address');
Route::post('/user/covers/add', 'HomeController@add_cover');

Route::post('/user/jobs/apply', 'HomeController@apply');

Route::get('/user/manage/order', 'HomeController@order');
Route::get('/user/manage/sale/{id}', 'HomeController@checkout');
Route::get('/user/manage/checkout/{id}', 'HomeController@checkout');
Route::get('/user/ad/sale', 'HomeController@agree_sale');


Route::get('/user/order/mark/received/{id}', 'HomeController@mark_received');
Route::get('/user/order/mark/shipped/{id}', 'HomeController@mark_shipped');
Route::get('/user/order/cancel/sale/{id}', 'HomeController@cancel_sale');


Route::get('/user/order/provide/tracking/{id}', 'HomeController@provide_tracking');
Route::post('/user/order/update/tracking', 'HomeController@update_tracking');


Route::post('/user/money/withdraw', 'HomeController@withdraw');
Route::post('/user/documents/identity', 'HomeController@identity');

Route::post('/user/terms/accept', 'HomeController@terms');

Route::get('/user/redirect/{id}', 'HomeController@c_login');

Route::get('/user/send/text', 'HomeController@text');
Route::get('/user/verify/text', 'HomeController@verify_text');
Route::get('/user/email/resend', 'HomeController@resend_email');

Route::get('/user/address/change/{id}', 'HomeController@change');
Route::get('/user/manage/order/shipping/update/{id}', 'HomeController@update_shipping');
Route::get('/user/generate/pdf', 'HomeController@pdf');


Route::get('/business/manage/ads', 'BusinessController@myads');
Route::get('/business/manage/finance', 'BusinessController@finance');
Route::get('/business/manage/details', 'BusinessController@details');
Route::get('/business/manage/company', 'BusinessController@company');
Route::get('/business/manage/metrics', 'BusinessController@metrics');
Route::get('/business/manage/support', 'BusinessController@support');

Route::post('/business/manage/bump', 'BusinessController@bump');
Route::get('/pay/invoice/{id}', 'HomeController@pay');
Route::get('/pay-logout/invoice/{id}', 'MarketController@payLogout');

Route::get('/business/invoice/pay/{id}', 'BusinessController@invoice');

Route::get('/user/reply/{id}', 'MessageController@reply');
Route::get('/user/areply/{id}', 'MessageController@contact_applicant');
Route::get('/user/breply/{id}', 'MessageController@contact_buyer');


Route::get('/user/manage/orders', 'HomeController@orders');
Route::get('/user/manage/buying', 'HomeController@buying');
Route::get('/user/manage/details', 'BusinessController@details');

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
Route::post('/user/payment/sale/stripe/{id}', 'HomeController@sale_stripe');
Route::post('/user/payment/invoice/stripe/{id}', 'HomeController@invoice_stripe');

Route::get('/user/payment/sale/paypal/{id}', 'HomeController@sale_paypal');
Route::post('/user/payment/sale/paypal/{id}', 'HomeController@sale_paypal');

Route::get('/user/payment/invoice/paypal/{id}', 'HomeController@invoice_paypal');
Route::post('/user/payment/invoice/paypal/{id}', 'HomeController@invoice_paypal');
Route::get('/user/payment/paypal', 'HomeController@paypal');

Route::get('/user/email/verify', 'HomeController@verify');
Route::post('/user/list/favorite','UserController@favorite')->middleware('auth');
Route::post('/user/list/unfavorite','UserController@unfavorite')->middleware('auth');
Route::get('/user/list/price','UserController@price')->middleware('auth');

Route::get('/user/advert/delete/{id}', 'HomeController@delete');
Route::get('/user/advert/repost/{id}', 'HomeController@repost');
Route::get('/user/advert/edit/{id}', 'HomeController@edit');

Route::get('/user/advert/duplicate/{id}', 'HomeController@duplicate');

Route::post('/user/advert/save', 'HomeController@save');

Route::get('/user/p/stats/{id}', 'HomeController@stats');


Route::get('/category/children/{id}', 'HomeController@children');
Route::get('/location/children/{id}', 'HomeController@lchildren');
Route::get('/postcodes/postcode', 'HomeController@postcode');

Route::get('/category/extras/{id}', 'HomeController@extras');
Route::get('/category/prices/{id}', 'HomeController@prices');
Route::get('/category/price/{id}', 'HomeController@price');

Route::get('/category/total/{id}', 'HomeController@total');
Route::get('/product/total', 'HomeController@ad_total');


Route::get('/category/suggest', 'HomeController@suggest');
Route::get('/category/string/{id}', 'HomeController@string');
Route::get('/location/string/{id}', 'HomeController@lstring');

Route::get('/fields/{any}', 'MarketController@fields');
Route::get('/filters/{any}', 'MarketController@filters');

Route::get('/id/{id}', 'MarketController@id');
Route::get('/agent/{id}', 'MarketController@agent');
Route::get('/company/{id}', 'MarketController@company');

Route::get('/job/profile/edit', 'HomeController@profile');
Route::post('/job/profile/save', 'HomeController@save_profile');
Route::get('/job/profile/view/{id}', 'HomeController@view_profile');

Route::get('/profile/{id}', 'MarketController@profile');
Route::get('/download-mobile-apps/', 'MarketController@downloadApps');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Auth::routes();

Route::get('/jobscats', 'MarketController@jobscats');
Route::get('/notfound', 'MarketController@notfound');

Route::get('/', 'MarketController@index');
Route::get('/cleaves','MarketController@leaves');
Route::get('/leaves','MarketController@lleaves');
Route::get('/make-contact/{id}', 'MarketController@makeContact');
Route::get('/companies/{id}', 'MarketController@companies');
Route::get('/p/r/{cat}/{id}', 'HomeController@product_url');

Route::get('/p/{cat}/{id}', 'MarketController@product');

Route::get('/{any}', 'MarketController@search');
Route::get('/{any}/{loc}', 'MarketController@lsearch');
Route::namespace('Admin')->group(function () {
    Route::post('/admin/manage/pricegroup/add', 'AdminController@add_pricegroup')->middleware('admin');
    Route::get('/admin/manage/pricegroup/edit/{id}', 'AdminController@edit_pricegroup')->middleware('admin');
    Route::get('/admin/manage/pricegroup/delete/{id}', 'AdminController@delete_pricegroup')->middleware('admin');
    Route::get('/admin/manage/packs', 'AdminController@packs')->middleware('admin');
    Route::get('/admin/manage/pricegroup', 'AdminController@pricegroup')->middleware('admin');
    Route::get('/admin/manage/role', 'AdminController@iam')->middleware('admin');
});