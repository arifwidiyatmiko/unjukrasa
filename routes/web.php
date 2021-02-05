<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('dashboard.login.index');
});
Route::post('/login', 'DashboardController@login');
Route::group(['prefix' => 'dashboard', 'middleware' => ['LoginCheck']], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/logout', 'DashboardController@logout');
    Route::get('/import', 'DashboardController@importView');
    Route::POST('/import', 'DashboardController@import');

    Route::group(['prefix' => 'demonstration'], function () {
        Route::get('/', 'DashboardController@demoView');
        Route::get('/data', 'DashboardController@demoData')->name('api.demo');
    });

    Route::group(['prefix' => 'pic'], function () {
        Route::get('/', 'AlianceController@picView');
        Route::get('/data', 'AlianceController@picData')->name('api.pic');
        Route::get('/detail/{id}', 'AlianceController@picAllience');
    });

    Route::group(['prefix' => 'province'], function () {
        Route::get('/', 'DashboardController@areaView');
        Route::get('/data', 'LocationController@areaData')->name('api.area');
    });
    Route::group(['prefix' => 'location'], function () {
        Route::get('/', 'DashboardController@locationView');
        Route::get('/data', 'LocationController@locationData')->name('api.location');
        Route::get('/update/{id}', 'LocationController@locationUpdate');
        Route::POST('/update/{id}', 'LocationController@localtionDoUpdate');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index');
        Route::get('/tambah', 'UserController@create');
        Route::post('/tambah', 'UserController@insert');
        Route::get('/data', 'UserController@userData')->name('api.user');
        Route::get('/update/{id}', 'UserController@userUpdate');
        Route::POST('/update/{id}', 'UserController@userDoUpdate');
        Route::get('/delete/{id}', 'UserController@delete');
    });
    Route::group(['prefix' => 'alience'], function () {
        Route::get('/', 'DashboardController@alianceView');
        Route::get('/data', 'AlianceController@alianceData')->name('api.aliance');
        Route::get('/detail/{id}', 'AlianceController@picDetail');
        Route::get('/pic/update/{id}', 'AlianceController@aliancePicUpdate');
        Route::POST('/pic/update/{id}', 'AlianceController@aliancenPicDoUpdate');
        Route::get('/update/{id}', 'AlianceController@alianceUpdate');
        Route::POST('/update/{id}', 'AlianceController@aliancenDoUpdate');
    });
});
