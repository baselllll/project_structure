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
Route::post('password/email', [\Modules\UserModule\Http\Controllers\ForgotPasswordController::class,'forgot']);

Route::post('password/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
Route::middleware('auth:api')->prefix('users')->group(function () {

//    Route::post('sendmessage', [\App\Http\Controllers\ChatController::class, 'sendMessage']);
    Route::post('sendmessage', [\App\Http\Controllers\ChatController::class, 'sendMessageOrdinally']);
    Route::post('addChat', [\App\Http\Controllers\ChatController::class, 'addChat']);
    Route::get('getconversation', [\App\Http\Controllers\ChatController::class, 'getconversation']);
    Route::get('search-ride',[\Modules\UserModule\Http\Controllers\OfferRideController::class,'searchOnRideOffer']);
    Route::post('update-status/{offer_ride_id}',[\Modules\UserModule\Http\Controllers\OfferRideController::class,'updateStatusRideOffer']);
    Route::post('update-message/{offer_ride_id}',[\Modules\UserModule\Http\Controllers\OfferRideController::class,'updateMessageOnRideOffer']);
    Route::prefix('driver')->group(function () {
       Route::apiResource('vechiles','VechileController');
       Route::apiResource('offer-ride','OfferRideController');
    });
});
