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
