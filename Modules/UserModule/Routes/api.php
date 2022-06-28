<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Modules\UserModule\Http\Controllers\UserLoginController;
use Modules\UserModule\Http\Controllers\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login-user',[UserLoginController::class,'loginUser']);
Route::post('register-user',[UserLoginController::class,'registerUser']);
Route::get('login/{provider}', [\Modules\UserModule\Http\Controllers\SocialLoginController::class, 'redirectToProvider'])
    ->where('provider', '(google|facebook|apple)')
    ->name('login.social.redirect');
Route::get('login/{provider}/callback', [\Modules\UserModule\Http\Controllers\SocialLoginController::class, 'handleProviderCallback'])
    ->where('provider', '(google|facebook|apple)')
    ->name('login.social.callback');
Route::post('password/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
Route::middleware('auth:api')->prefix('users')->group(function () {
    Route::prefix('driver')->group(function () {
       Route::apiResource('vechiles','VechileController');
       Route::apiResource('offer-ride','OfferRideController');
    });
});
