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

// Employees
Route::get('/', 'EmployeeController@index');
Route::post('/employees/add', 'EmployeeController@store');
Route::post('/employees/edit', 'EmployeeController@edit');
Route::post('/employees/update', 'EmployeeController@update');
Route::post('/employees/delete', 'EmployeeController@delete');
