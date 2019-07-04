<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', /*'middleware' => ['auth:admin','role:salesman']*/], function () {
    Route::get('/dashboard/testdata', 'DashboardController@testdata')->name('testdata');
    Route::get('/dashboard/test', 'DashboardController@test')->name('test');
    Route::resource('/dashboard', 'DashboardController');
    Route::resource('/report', 'ReportController');
});
