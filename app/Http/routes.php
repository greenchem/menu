<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'user'], function() {
    Route::get('menu', 'UserController@menu');
    Route::get('shoppingCart', 'UserController@shoppingCart');
    Route::get('fee', 'UserController@fee');
});

Route::group(['prefix'=>'manager'], function() {
    Route::get('account', 'ManagerController@account');
    Route::get('fee', 'ManagerController@fee');

    Route::group(['prefix'=>'menu'], function() {
        Route::get('menu', 'ManagerController@menuMenu');
        Route::get('export', 'ManagerController@menuExport');
        Route::get('edit/{id}', 'ManagerController@menuEdit');
    });
});
