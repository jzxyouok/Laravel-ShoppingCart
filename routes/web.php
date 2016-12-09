<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'ProductController@getIndex')->name('product.index');
Route::get('/add-to-cart/{id}', 'ProductController@getAddToCart')->name('product.addToCart');
Route::get('/shopping-cart', 'ProductController@getCart')->name('product.shoppingCart');
Route::get('/reduce/{id}', 'ProductController@getReductByOne')->name('product.reduceByOne');
Route::get('/remove/{id}', 'ProductController@getRemoveItem')->name('product.remove');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/checkout', 'ProductController@getCheckout')->name('checkout');
    Route::post('/checkout', 'ProductController@postCheckout')->name('checkout');
});


Route::group(['prefix' => 'user'], function() {
    Route::group(['middleware' => 'guest'], function() {
        Route::get('/signup', 'UserController@getSignup')->name('user.signup');
        Route::post('/signup', 'UserController@postSignup')->name('user.signup');

        Route::get('/signin', 'UserController@getSignin')->name('user.signin');
        Route::post('/signin', 'UserController@postSignin')->name('user.signin');
    });

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/profile', 'UserController@getProfile')->name('user.profile');
        Route::get('/logout', 'UserController@getLogout')->name('user.logout');
    });

});
