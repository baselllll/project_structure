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

Route::get('auth/{provider}', [\Modules\UserModule\Http\Controllers\SocialLoginController::class, 'redirectToProvider'])
    ->where('provider', '(google|facebook|apple)')
    ->name('login.social.redirect');
Route::get('auth/{provider}/callback', [\Modules\UserModule\Http\Controllers\SocialLoginController::class, 'handleProviderCallback'])
    ->where('provider', '(google|facebook|apple)')
    ->name('login.social.callback');

Route::get('/', function () {
    return view('welcome');
});
