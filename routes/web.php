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
})->name('home');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Route::get('/user', 'UserController@user')->name('user');
Route::get('/user/domain', 'UserController@domain')->name('user.domain');
Route::get('/user/hosting', 'UserController@hosting')->name('user.hosting');
Route::get('/user/hosting/{id}', 'UserController@hosting');
