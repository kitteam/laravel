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

Route::group(['prefix' => 'user'], function () {
    Route::get('', 'UserController@index')->name('user.index');
    Route::get('domain', 'UserController@domain')->name('user.domain');
    Route::get('hosting', 'UserController@hosting')->name('user.hosting');
    Route::get('hosting/{id}', 'UserController@hosting');
});

Route::group(['prefix' => 'crm'], function () {
    Route::get('', 'CrmController@index')->name('crm');
    Route::get('account', 'CrmController@account')->name('crm.account');
    Route::get('account/auth/{id}', 'CrmController@auth');
});

Route::group(['prefix' => 'callback'], function () {
    Route::get('tele2', function (Request $request) {
        if (($key = $request::get('key')) && $key == env('TELE2_CALLBACK_KEY')) {
            return Artisan::call('callback:tele2', []);
        }
        return response()->json([ 'error' => 'Wrong authorized key' ], 403);
    });

    Route::post('telegram', function (PhpTelegramBot\Laravel\PhpTelegramBotContract $telegram_bot) {
        $telegram_bot->handle();
    });

    Route::get('update', function () {
        return Artisan::call('cover_photo:upload', []);
    });
});
