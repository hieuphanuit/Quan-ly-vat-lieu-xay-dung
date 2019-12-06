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

/** Auth */
Route::group(['middleware' => 'api'], function () {
    Route::group([
        'prefix' => 'auth',
    ],  function ($router) {
        Route::post('/login', 'AuthController@login');
    });

    Route::group([
        'middleware' => 'auth:api',
        'prefix' => 'auth'
    ],  function ($router) {
        Route::post('/change-password', 'AuthController@logout');
        Route::post('/logout', 'AuthController@logout');
        Route::post('/refresh', 'AuthController@refresh');
        Route::post('/info', 'AuthController@info');
    });


    Route::group([
        'middleware' => 'auth.role:0',
        'prefix' => 'category'
    ],  function ($router) {
        Route::get('/', 'CategoryController@index');
        Route::get('/select-list', 'CategoryController@selectList');
        Route::get('/{id}', 'CategoryController@detail')->where(['id' => '[0-9]+']);;
        Route::post('/', 'CategoryController@create');
        Route::put('/{id}', 'CategoryController@update');
        Route::delete('/{id}', 'CategoryController@delete');
    });

    Route::group([
        'middleware' => 'auth.role:0',
        'prefix' => 'product'
    ],  function ($router) {
        Route::get('/', 'ProductController@index');
        Route::get('/{id}', 'ProductController@detail');
        Route::post('/', 'ProductController@create');
        Route::put('/{id}', 'ProductController@update');
        Route::delete('/{id}', 'ProductController@delete');
    });

    Route::group([
        'middleware' => 'auth.role:0',      //business staff
        'prefix' => 'customer'
    ],  function ($router) {
        Route::get('/', 'CustomerController@index');
        Route::get('/{id}', 'CustomerController@detail');
        Route::post('', 'CustomerController@create');
        Route::put('/{id}', 'CustomerController@update');
        Route::delete('/{id}', 'CustomerController@delete');
    });
});

Route::group([
    'middleware' => 'auth.role:2',      //business staff
    'prefix' => 'selling-bill'
],  function ($router) {
    Route::post('', 'SellingBillController@create');
    Route::delete('/{id}', 'SellingBillController@delete');
    Route::put('/{id}', 'SellingBillController@update');
});

Route::group([
    'middleware' => 'auth.role:3',      //agency manager
    'prefix' => 'import-goods-bill'
],  function ($router) {
    Route::post('', 'SellingBillController@create');
    Route::delete('/{id}', 'SellingBillController@delete');
    Route::put('/{id}', 'SellingBillController@update');
    Route::get('/select-list','SelectBillController@selectList');

});

Route::group([
    'middleware' => 'auth.role:0',
    'prefix' => 'agency'
],  function ($router) {
    Route::get('/', 'AgencyController@index');
    Route::get('/{id}', 'AgencyController@detail')->where(['id' => '[0-9]+']);;
    Route::get('/get-list','AgencyController@getList');
    Route::post('/', 'AgencyController@create');
    Route::put('/{id}', 'AgencyController@update');
    Route::delete('/{id}', 'AgencyController@delete');
});

Route::group([
   'middleware' => 'auth.role:0',
    'prefix' => 'vendor'
], function (){
    Route::post('/','VendorController@create');
    Route::delete('/{id}','VendorController@delete');
    Route::get('/','VendorController@index');
    Route::get('/{id}','VendorController@detail');
    Route::put('/{id}','VendorController@update');
});

Route::group([
   // 'middleware' => 'auth.role:0',
    'prefix' =>  'angency-product'
],function(){
    Route::post('/','AngencyProductController@create');
    Route::delete('/{id}','AngencyProductController@delete');
    Route::get('/','AngencyProductController@index');
    Route::get('/{id}','AngencyProductController@detail');
    Route::put('/{id}','AngencyProductController@update');
});

Route::group([
    // 'middleware' => 'auth.role:0',
     'prefix' =>  'user'
 ],function(){
     Route::post('/','UserController@create');
     Route::delete('/{id}','UserController@delete');
     Route::get('/','UserController@index');
     Route::get('/{id}','UserController@detail');
     Route::put('/{id}','UserController@update');
 });
 