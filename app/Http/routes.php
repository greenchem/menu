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
        Route::group(['prefix' => 'product'], function() {
            Route::get('/', 'ProductController@index');
            Route::post('/', 'ProductController@create'); // for creating a singel record
            Route::post('/list', 'ProductCotroller@createList'); // for creating a list of record
            Route::put('/{id}', 'ProductController@update');
            Route::delete('/{id}', 'ProductController@destroy');
        });

        Route::group(['prefix' => 'menu'], function() {
            Route::get('/', 'MenuController@index'); // Indexing by its status & company.
            Route::get('/all', 'MenuController@indexAll'); // Indexing by self's company.
            Route::get('/{id}', 'MenuController@show'); // To show a menu's detail (Products & others): for import.
            Route::post('/', 'MenuController@create');
            Route::put('/{id}', 'MenuController@update'); // Cannot update period_id!!
            Route::put('/{id}/products', 'MenuController@updateProducts'); // for updating Menu's products.
            Route::delete('/{id}', 'MenuController@destroy');
        });

        Route::group(['prefix' => 'booking_log'], function() {
            Route::get('/', 'BookingLogController@index'); // indexing by Period / user_id.
            Route::get('/{id}', 'BookingLogController@show');
            Route::post('/', 'BookingLogController@create');
            Route::put('/{id}', 'BookingLogController@update'); // when to update record from 'not_confirmed' to 'confirmed' ?
            Route::delete('/{id}', 'BookingLogController@destroy');

            Route::get('/stocking_form', 'BookingLogController@exportStockingForm'); // Export stocking form with user's company.
            Route::get('/confirmation_form', 'BookingLogController@exportConfirmationFrom'); // Export confirmation form with user's company.

            // Export All the companies' confirmation form.
            Route::get('/all_confirmation_form', 'BookingLogController@exportAllConfirmationFrom');
        });

        Route::group(['prefix' => 'period'], function() {
            Route::get('/', 'PeriodController@index');
            Route::post('/', 'PeriodController@create');
            Route::put('/{id}', 'PeriodController@update');
            Route::delete('/{id}', 'PeriodController@delete'); // soft delete
        });

        Route::group(['prefix' => 'user_quota'], function() {
            Route::get('/', 'UserQuotaController@index'); // Need to be filtered with period.
            Route::post('/', 'UserQuotaController@create');
            Route::put('/{id}', 'UserQuotaController@update');

            // No need for delete ?
        });
    });

    Route::group(['prefix' => 'accounting_sys', 'namespace' => 'AccountingSys'], function() {});
});

