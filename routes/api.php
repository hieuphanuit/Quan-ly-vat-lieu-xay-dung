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
Route::group([
    'prefix' => 'auth',
],  function ($router) {
    Route::post('/login', 'AuthController@login');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
],  function ($router) {
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::post('/info', 'AuthController@info');
});


Route::group([
    'middleware' => 'auth.role:0',
    'prefix' => 'category'
],  function ($router) {
    Route::get('/', 'CategoryController@index');
    Route::get('/{id}', 'CategoryController@detail');
    Route::post('/', 'CategoryController@create');
    Route::put('/{id}', 'CategoryController@update');
    Route::delete('/{id}', 'CategoryController@delete');
});

Route::group([
   // 'middleware' => 'auth.role:2',      //business staff
    'prefix' => 'customer'
],  function ($router) {
    Route::post('/create', 'CustomerController@create');
    Route::delete('/{id}', 'CustomerController@delete');
    Route::put('/{id}', 'CustomerController@update');
});


Route::group([
    'middleware' => 'auth.role:2',      //business staff
    'prefix' => 'product'
],  function ($router) {
    Route::get('/', 'ProductController@index');
    Route::get('/{id}', 'ProductController@detail');
    Route::post('/', 'ProductController@create');
    Route::put('/{id}', 'ProductController@update');
    Route::delete('/{id}', 'ProductController@delete');
});




