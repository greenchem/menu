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

Route::get('login', function() {
    return Auth::loginUsingId(1);
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

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function() {
    Route::group(['prefix' => 'account_sys', 'namespace' => 'AccountSys'], function() {
        Route::group(['prefix' => 'auth'], function() {
            Route::get('login', 'AuthController@login');
            Route::get('logout', 'AuthController@logout');
        });

        Route::group(['prefix' => 'user'], function() {
            Route::get('/', 'UserController@index');
            Route::post('/', 'UserController@create');
            Route::get('/{id}', 'UserController@show');
            Route::put('/{id}', 'UserController@update');
            Route::put('/{id}/{role_id}', 'UserController@updateRole');
            Route::delete('/{id}', 'UserController@destroy');
            Route::delete('/{id}/{role_id}', 'UserController@destroyRole');
        });

        Route::group(['prefix' => 'company'], function() {
            Route::get('/', 'CompanyController@index');
            Route::get('/{id}', 'CompanyController@show');
            Route::post('/', 'CompanyController@create');
            Route::put('/{id}', 'CompanyController@update');
            Route::delete('/{id}', 'CompanyController@destroy');
        });

        Route::group(['prefix' => 'group'], function() {
            Route::get('/', 'GroupController@index');
            Route::get('/{id}', 'GroupController@show');
            Route::post('/', 'GroupController@create');
            Route::put('/{id}', 'GroupController@update');
            Route::put('/{id}/{company_id}', 'GroupController@update');
            Route::delete('/{id}', 'GroupController@destroy');
        });

        Route::group(['prefix' => 'role'], function() {
            Route::get('/', 'RoleController@index');
            Route::get('/{id}', 'RoleController@show');
        });

        Route::group(['prefix' => 'permission'], function() {
            Route::get('/', 'PermissionController@index');
        });
    });

    Route::group(['prefix' => 'menu_sys', 'namespace' => 'MenuSys'], function() {
        Route::group(['prefix' => 'product'], function() {});

        Route::group(['prefix' => 'menu'], function() {});

        Route::group(['prefix' => 'booking_log'], function() {});

        Route::group(['prefix' => 'period'], function() {});

        Route::group(['prefix' => 'user_quota'], function() {});
    });

    Route::group(['prefix' => 'accounting_sys', 'namespace' => 'AccountingSys'], function() {});
});

