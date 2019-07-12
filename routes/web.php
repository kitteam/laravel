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
    Route::any('tele2', 'Telephony\WebhookController@handle');
    Route::any('telegram', 'Telegram\WebhookController@handle');

    Route::get('update', function () {
        return Artisan::call('cover_photo:upload', []);
    });
});
