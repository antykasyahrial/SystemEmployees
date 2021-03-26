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

Route::get('/login', 'App\Http\Controllers\EmployeeController@index')->name('login.index');
Route::get('/logout', 'App\Http\Controllers\EmployeeController@logout')->name('login.logout');
Route::post('/login', 'App\Http\Controllers\EmployeeController@process')->name('process');
Route::get('/add', 'App\Http\Controllers\EmployeeController@add')->name('addData');
Route::post('/add', 'App\Http\Controllers\EmployeeController@store')->name('storeData');
Route::get('/dashboard', 'App\Http\Controllers\EmployeeController@show')->name('dashboard');
Route::get('/delete/{id}', 'App\Http\Controllers\EmployeeController@destroy')->name('delete');

Auth::routes();
