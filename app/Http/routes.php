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
    Route::get('login', 'UserController@login');
    Route::get('menu', 'UserController@menu');
    Route::get('shoppingCart', 'UserController@shoppingCart');
    Route::get('history', 'UserController@history');

    Route::group(['prefix'=>'fee'], function() {
        Route::get('meal', 'UserController@feeMeal');
        Route::get('dorm', 'UserController@feeDorm');
        Route::get('parking', 'UserController@feeParking');
        Route::get('attendance', 'UserController@feeAttendance');
        Route::get('weekendAttendance', 'UserController@feeWeekendAttendance');
    });
});

Route::group(['prefix'=>'menuManager'], function() {
    Route::get('menu', 'MenuManagerController@menu');
    Route::get('export', 'MenuManagerController@export');
    Route::get('add', 'MenuManagerController@add');
    Route::get('edit/{id}', 'MenuManagerController@edit');
});

Route::group(['prefix'=>'manager'], function() {
    Route::get('login', 'ManagerController@login');
    Route::get('account', 'ManagerController@account');
    Route::get('menu', 'ManagerController@menu');

    Route::group(['prefix'=>'fee'], function() {
        Route::get('meal', 'ManagerController@feeMeal');
        Route::get('dorm', 'ManagerController@feeDorm');
        Route::get('parking', 'ManagerController@feeParking');
        Route::get('attendance', 'ManagerController@feeAttendance');
        Route::get('weekendAttendance', 'ManagerController@feeWeekendAttendance');
    });
});

