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

Route::get('/', [
    'uses' => 'StoreController@getHomePage',
    'as' => 'home'
]);

Route::get('/clothing', [
    'uses' => 'StoreController@getClothing',
    'as' => 'clothing'
]);

Route::get('/mugs', [
    'uses' => 'StoreController@getMugs',
    'as' => 'mugs'
]);


Route::post('store-post', [
    'uses' => 'StoreController@postStorePage',
    'as' => 'store-post'
]);

Route::get('/cart', [
    'uses' => 'StoreController@getShoppingCart',
    'as' => 'shopping-cart'
]);

Route::get('cart/cart-delete/{id}', [
    'uses' => 'StoreController@deleteShoppingCart',
    'as' => 'cart-delete'
]);

Route::get('cart/cart-edit/{id}', [
    'uses' => 'StoreController@updateShoppingCart',
    'as' => 'cart-edit'
]);

Route::get('/shipping', [
    'uses' => 'StoreController@getShippingInfo',
    'as' => 'shipping'
]);

Route::get('shipping-add', [
    'uses' => 'StoreController@addShippingInfo',
    'as' => 'shipping-add'
]);

Route::get('/preview', [
    'uses' => 'StoreController@getPreview',
    'as' => 'preview'
]);

Route::get('/add-payment', [
    'uses' => 'StoreController@addPayment',
    'as' => 'add-payment'
]);

Route::get('/receipt', [
    'uses' => 'StoreController@getRecipt',
    'as' => 'receipt'
]);
