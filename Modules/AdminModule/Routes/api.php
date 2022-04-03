<?php

use Illuminate\Http\Request;
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
Route::post('login',[JWtAuthController::class,'loginUserExample']);
Route::middleware('auth:admin')->prefix('admins')->group(function () {
    Route::get('get-all-users',[UserLoginController::class,'GetAllUser']);
});