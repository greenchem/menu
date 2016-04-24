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
    Route::get('history', 'UserController@history');
    Route::get('fee', 'UserController@fee');
});

Route::group(['prefix'=>'manager'], function() {
    Route::get('account', 'ManagerController@account');

    Route::group(['prefix'=>'menu'], function() {
        Route::get('menu', 'ManagerController@menuMenu');
        Route::get('export', 'ManagerController@menuExport');
        Route::get('add', 'ManagerController@menuAdd');
        Route::get('edit/{id}', 'ManagerController@menuEdit');
    });

    Route::group(['prefix'=>'fee'], function() {
        Route::get('dorm', 'ManagerController@feeDorm');
        Route::get('meal', 'ManagerController@feeMeal');
        Route::get('parking', 'ManagerController@feeParking');
        Route::get('attendance', 'ManagerController@feeAttendance');
        Route::get('weekendAttendance', 'ManagerController@feeWeekendAttendance');
    });
});
