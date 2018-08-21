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
// Get methods
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home','DashboardController@getHome')->name('home');
// Route::get('/login', 'DashboardController@getlogin');
Route::get('/logout','DashboardController@postLogout');
Route::get('/products','DashboardController@getProducts');
Route::get('/sales','DashboardController@getSales');
Route::get('/employees','DashboardController@getEmployees');

// Post Methods
Route::post('/generateInvoice','DashboardController@generateInvoice');
Route::post('/login', 'DashboardController@postlogin');
Route::post('/addProduct','DashboardController@addProducts');
Route::post('/deleteItem','DashboardController@deleteItem');
Route::post('/editItem','DashboardController@editItem');
Route::post('/addEmployee','DashboardController@addEmployee');
Route::post('/deleteUser','DashboardController@deleteUser');
Route::post('/editUser','DashboardController@editUser');