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

Route::group(['prefix' => 'cp'], function () {
    Route::get('', 'ControlPanel\MainController@index')->name('cp.index');
    // Domain management
    Route::get('domain', 'ControlPanel\DomainController@list')->name('cp.domain.list');
    Route::get('domain/{id}', 'ControlPanel\DomainController@info')->name('cp.domain.info');
    // Hosting management
    Route::get('hosting', 'ControlPanel\HostingController@list')->name('cp.hosting.list');
    Route::get('hosting/{id}', 'ControlPanel\HostingController@vesta');
});

Route::group(['prefix' => 'mc'], function () {
    Route::get('', 'MissionControl\MainController@index')->name('mc.index');
    // Account management
    Route::get('account', 'MissionControl\AccountController@list')->name('mc.account.list');
    Route::get('account/auth/{id}', 'MissionControl\AccountController@auth');

    Route::get('telephony', 'MissionControl\TelephonyController@history')->name('mc.telephony.history');
});

Route::group(['prefix' => 'callback'], function () {
    Route::get('tele2', function (Request $request) {
        if (($key = $request::get('key')) && $key == env('TELE2_CALLBACK_KEY')) {
            return Artisan::call('callback:tele2', []);
        }
        return response()->json([ 'error' => 'Wrong authorized key' ], 403);
    });

    Route::any('telegram', 'Telegram\WebhookController@handle');

    Route::get('update', function () {
        return Artisan::call('cover_photo:upload', []);
    });
});
