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

Route::get('error', function() {
    return view('error');
});

Route::group(['middleware' => ['error:User'], 'prefix'=>'user'], function() {
    Route::get('menu', 'UserController@menu');
    Route::get('shoppingCart', 'UserController@shoppingCart');
    Route::get('history', 'UserController@history');
    Route::get('password', 'UserController@password');
});

Route::group(['middleware' => ['error:MenuManager'], 'prefix'=>'menuManager'], function() {
    Route::get('menu', 'MenuManagerController@menu');
    Route::get('export', 'MenuManagerController@export');
    Route::get('add', 'MenuManagerController@add');
    Route::get('edit/{id}', 'MenuManagerController@edit');
});

Route::group(['middleware' => ['error:Accountant'], 'prefix'=>'feeManager'], function() {
    Route::get('meal', 'FeeManagerController@meal');
    Route::get('dorm', 'FeeManagerController@dorm');
    Route::get('parking', 'FeeManagerController@parking');
    Route::get('attendance', 'FeeManagerController@attendance');
    Route::get('weekendAttendance', 'FeeManagerController@weekendAttendance');

    Route::get('menuExport', 'FeeManagerController@menuExport');
    Route::get('feeExport', 'FeeManagerController@feeExport');
    Route::get('period', 'FeeManagerController@period');
    Route::get('booking', 'FeeManagerController@booking');
    Route::get('setQuoda', 'FeeManagerController@setQuoda');
});

Route::group(['middleware' => ['error:AccountsManager'], 'prefix'=>'accountManager'], function() {
    Route::get('account', 'AccountManagerController@account');
    Route::get('company', 'AccountManagerController@company');
});

Route::group(['middleware' => ['error:Admin'], 'prefix'=>'master'], function() {
    Route::get('editFeeSetting', 'MasterController@editFeeSetting');
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
            Route::put('/user/{id}', 'UserController@update');
            Route::put('/role/{id}/{role_id}', 'UserController@updateRole');
            Route::put('/password/{id}', 'UserController@updatePassword');
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
            Route::get('/', 'ProductController@index'); // filting with menu_id
            Route::post('/', 'ProductController@create'); // for creating a singel record
            Route::post('/list', 'ProductController@createList'); // for creating a list of record (using menu_id)
            Route::put('/single/{id}', 'ProductController@update');
            Route::delete('/single/{id}', 'ProductController@destroy');
            Route::delete('/list', 'ProductController@destroyList'); // for deleting a list of record (using menu_id)
        });

        Route::group(['prefix' => 'menu'], function() {
            Route::get('/', 'MenuController@index'); // Indexing by its status & company.
            Route::get('/all', 'MenuController@indexAll'); // Indexing by self's company.
            Route::get('/single/{id}', 'MenuController@show'); // To show a menu's detail (Products & others): for import.
            Route::post('/', 'MenuController@create');
            Route::put('/{id}', 'MenuController@update'); // Cannot update period_id!!, PS: to update products, PLZ use post/delete product/list.
            Route::delete('/{id}', 'MenuController@destroy');
        });

        Route::group(['prefix' => 'booking_log'], function() {
            Route::get('/', 'BookingLogController@index'); // indexing by Period / user_id.
            Route::get('/{id}', 'BookingLogController@show');
            Route::post('/', 'BookingLogController@create');
            Route::put('/{id}', 'BookingLogController@update'); // No need to update to comfirmed...
            Route::delete('/{id}', 'BookingLogController@destroy');
        });

        Route::group(['prefix' => 'exports'], function() {
            Route::get('/stocking_form', 'BookingLogController@exportStockingForm'); // Export stocking form with user's company.
            Route::get('/accounting_form', 'BookingLogController@exportAccountingForm'); // Export accounting form with user's company.
            // Export All the companies' accounting form.
            Route::get('/all_accounting_form', 'BookingLogController@exportAllAccountingForm');
        });

        Route::group(['prefix' => 'period'], function() {
            Route::get('/', 'PeriodController@index');
            Route::post('/', 'PeriodController@create');
            Route::put('/{id}', 'PeriodController@update');
            Route::delete('/{id}', 'PeriodController@destroy'); // soft delete
        });

        Route::group(['prefix' => 'user_quota'], function() {
            Route::get('/', 'UserQuotaController@index'); // Need to be filtered with period.
            Route::post('/', 'UserQuotaController@create');
            Route::put('/{id}', 'UserQuotaController@update');
            Route::delete('/{id}', 'UserQuotaController@destroy');

            // No need for delete ?
        });
    });

    Route::group(['prefix' => 'accounting_sys', 'namespace' => 'AccountingSys'], function() {
        Route::group(['prefix' => 'fee_log'], function() {
            Route::get('/', 'FeeLogController@index'); // list out all the fee logs that belongs the provided creation_log_id.
            Route::delete('/list', 'FeeLogController@destroy'); // using (creation_log_id)
            });

        Route::group(['prefix' => 'creation_log'], function() {
            Route::get('/', 'CreationLogController@index'); // list out all the creation logs.
            Route::post('/', 'CreationLogController@create'); // Need <timestamp> <type> <array([user_id, fee])>
            Route::delete('/{id}', 'CreationLogController@destroy');

            Route::get('/export', 'CreationLogController@export'); // Need <timestamp> <period_id>

            Route::put('/unlock/{id}', 'CreationLogController@unlock'); // To unlock an record.
        });
    });
});

