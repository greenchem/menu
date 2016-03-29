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

Route::group(['prefix'=>'demonic'], function() {
    Route::group(['prefix'=>'user'], function() {
        Route::get('menu', 'DemonicUserController@menu');
        Route::get('fee', 'DemonicUserController@fee');
    });

    Route::group(['prefix'=>'manager'], function() {
        Route::get('account', 'DemonicManagerController@account');
        Route::get('fee', 'DemonicManagerController@fee');

        Route::group(['prefix'=>'menu'], function() {
            Route::get('element', 'DemonicManagerController@menuElement');
            Route::get('menu', 'DemonicManagerController@menuMenu');
            Route::get('export', 'DemonicManagerController@menuExport');
        });
    });
});

