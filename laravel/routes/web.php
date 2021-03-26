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

Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('login');
Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');
Route::post('/login', 'App\Http\Controllers\LoginController@process')->name('process');
Route::get('/handleLogin', 'App\Http\Controllers\LoginController@authenticated')->name('handleLogin');
// Route::get('/add', 'App\Http\Controllers\EmployeeController@add')->name('addData');
// Route::post('/add', 'App\Http\Controllers\EmployeeController@store')->name('storeData');
// Route::get('/dashboard', 'App\Http\Controllers\EmployeeController@show')->name('dashboard');
// Route::get('/delete/{id}', 'App\Http\Controllers\EmployeeController@destroy')->name('delete');
 Route::get('/edit/{id}', 'App\Http\Controllers\EmployeeController@edit')->name('edit');
// Route::post('/edit/{id}', 'App\Http\Controllers\EmployeeController@update')->name('update');

Route::group(['middleware' => ['manager_auth']], function() {
    Route::get('/add', 'App\Http\Controllers\EmployeeController@add')->name('addData');
    Route::post('/add', 'App\Http\Controllers\EmployeeController@store')->name('storeData');
    Route::get('/dashboard', 'App\Http\Controllers\EmployeeController@show')->name('dashboard');
    Route::get('/delete/{id}', 'App\Http\Controllers\EmployeeController@destroy')->name('delete');
    Route::get('/edit/{id}', 'App\Http\Controllers\EmployeeController@edit')->name('edit');
    Route::post('/edit/{id}', 'App\Http\Controllers\EmployeeController@update')->name('update');
});
Route::group(['middleware' => ['supervisor_auth']], function() {
    Route::get('/add', 'App\Http\Controllers\EmployeeController@add')->name('addData');
    Route::post('/add', 'App\Http\Controllers\EmployeeController@store')->name('storeData');
    Route::get('/dashboard', 'App\Http\Controllers\EmployeeController@show')->name('dashboard');
    //Route::get('/delete/{id}', 'App\Http\Controllers\EmployeeController@destroy')->name('delete');
    Route::get('/edit/{id}', 'App\Http\Controllers\EmployeeController@edit')->name('edit');
    Route::post('/edit/{id}', 'App\Http\Controllers\EmployeeController@update')->name('update');
});

// Route::group(['middleware' => ['role:staff']], function() {
//     Route::get('/profile', 'App\Http\Controllers\EmployeeController@profile')->name('profile');
// });
Route::get('/profile', 'App\Http\Controllers\EmployeeController@profile')->middleware('staff_auth')->name('profile');
Route::get('/staff/{id}', 'App\Http\Controllers\EmployeeController@staff')->name('staff')->middleware('staff_auth');
Route::post('/staff/{id}', 'App\Http\Controllers\EmployeeController@update')->name('update')->middleware('staff_auth');;