<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Modules\UserModule\Http\Controllers\UserLoginController;

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
Route::middleware('auth:api')->prefix('users')->group(function () {
    Route::prefix('driver')->group(function () {
       Route::apiResource('vechiles','VechileController');
       Route::apiResource('offer-ride','OfferRideController');
    });
});
