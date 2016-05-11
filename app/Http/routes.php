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
});

Route::group(['prefix'=>'menuManager'], function() {
    Route::get('menu', 'MenuManagerController@menu');
    Route::get('export', 'MenuManagerController@export');
    Route::get('add', 'MenuManagerController@add');
    Route::get('edit/{id}', 'MenuManagerController@edit');
});

Route::group(['prefix'=>'feeManager'], function() {
    Route::get('meal', 'FeeManagerController@meal');
    Route::get('dorm', 'FeeManagerController@dorm');
    Route::get('parking', 'FeeManagerController@parking');
    Route::get('attendance', 'FeeManagerController@attendance');
    Route::get('weekendAttendance', 'FeeManagerController@weekendAttendance');
});

Route::group(['prefix'=>'accountManager'], function() {
    Route::get('account', 'AccountManagerController@account');
    Route::get('company', 'AccountManagerController@company'); 
     
});

Route::group(['prefix'=>'master'], function() {
    Route::get('login', 'MasterController@login');
    Route::get('account', 'MasterController@account');
    Route::get('menu', 'MasterController@menu');

});

