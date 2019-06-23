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

// usage inside a laravel route
Route::get('/cover-vk', function()
{
    $img = Image::make('img/cover-vk.jpg');

    $array = [
        DB::table('user_domains')->count(),
        DB::table('user_hostings')->count(),
        DB::table('portfolio')->count(),
    ];

    $img->text($array[0], 784, 99, $font = function($font) {
        $font->file('fonts/OpenSans-ExtraBold.ttf');
        $font->size(44);
        $font->color('#ffffff');
        $font->align('left');
        $font->valign('top');
    });
    $img->text($array[1], 784, 181, $font);
    $img->text($array[2], 784, 260, $font);

    $text = trans_choice("Зарегистрированный\nдомен|Зарегистрированных\nдомена|Зарегистрированных\nдоменов", $array[0]);
    $img->text(mb_strtoupper($text), 876, 138, $font = function($font) {
        $font->file('fonts/RobotoSlab-Regular.ttf');
        $font->size(18);
        $font->color('#ffffff');
        $font->align('left');
        $font->valign('bottom');
    });
    $text = trans_choice("Активный\nхостинг аккаунт|Активных\nхостинг аккаунта|Активных\nхостинг аккаунтов", $array[1]);
    $img->text(mb_strtoupper($text), 876, 216, $font);
    $text = trans_choice("Разработанный\nсайт|Разработанных\nсайта|Разработанных\nсайтов", $array[2]);
    $img->text(mb_strtoupper($text), 876, 295, $font);

    return $img->response('jpg');
});
