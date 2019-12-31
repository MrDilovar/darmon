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

Route::get('/', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->where('product', '[0-9]+')->name('shop.show');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/{product}', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');

Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::get('/thankyou', 'CheckoutController@thankyou')->name('checkout.thankyou');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('track', 'TrackController@index')->name('track.index');
Route::post('track/search', 'TrackController@search')->name('track.search');
Route::get('track/show/{id}', 'TrackController@show')->name('track.show');

Route::get('feedback/create', 'Admin\FeedbackController@create')->name('feedback.create');
Route::post('feedback/store', 'Admin\FeedbackController@store')->name('feedback.store');

Auth::routes();

Route::group([
        'prefix'=>'admin',
        'as'=>'admin.',
        'namespace'=>'Admin',
        'middleware'=>['web', 'auth', 'admin']
    ], function () {
        Route::get('/', 'AdminController@index')->name('index');
        Route::resource('/product', 'ProductController');
        Route::resource('/order', 'OrderController');
        Route::resource('/feedback', 'FeedbackController', ['except'=>['create', 'store']]);
});

