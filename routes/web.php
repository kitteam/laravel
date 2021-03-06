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

Route::get('', 'FrontendController@index')->name('index');
Route::get('hosting', 'FrontendController@hosting')->name('hosting');
Route::get('service', 'FrontendController@service')->name('service');
Route::get('about', 'FrontendController@about')->name('about');
Route::get('support', 'FrontendController@support')->name('support');

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

    Route::any('account', 'ControlPanel\AccountController@info')->name('cp.account.info');
    Route::any('account/edit', 'ControlPanel\AccountController@edit')->name('cp.account.edit');
});

Route::group(['prefix' => 'mc'], function () {
    Route::get('', 'MissionControl\MainController@index')->name('mc.index');
    // Account management
    Route::get('account', 'MissionControl\AccountController@list')->name('mc.account.list');
    Route::get('account/auth/{id}', 'MissionControl\AccountController@auth');

    Route::get('telephony', 'MissionControl\TelephonyController@history')->name('mc.telephony.history');

    Route::get('cost', 'MissionControl\CostController@tld')->name('mc.cost.tld');

    Route::get('bot/runa', 'MissionControl\BotController@runa')->name('mc.bot.runa');

    Route::get('seo/shortlink', 'MissionControl\ShortlinkController@index')->name('mc.seo.shortlink');
    Route::post('seo/shortlink/add', 'MissionControl\ShortlinkController@add')->name('mc.seo.shortlink.add');
    Route::any('seo/shortlink/edit/{id}', 'MissionControl\ShortlinkController@edit')->name('mc.seo.shortlink.edit');
    Route::get('seo/shortlink/delete/{id}', 'MissionControl\ShortlinkController@delete')->name('mc.seo.shortlink.delete');
});

Route::get('/go/{shortlink}', 'MissionControl\ShortlinkController@link');

Route::group(['prefix' => 'callback'], function () {
    Route::any('tele2', 'Telephony\WebhookController@handle');
    Route::any('telegram', 'Telegram\WebhookController@handle');
    Route::any('vk', 'Vk\WebhookController@handle');
});

Route::get('/test', function (TerminalFa $terminal) {
    print_r($terminal::getStatus());
    die();
});
