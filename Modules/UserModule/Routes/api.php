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
    Route::get('get-all-users',[UserLoginController::class,'GetAllUser']);
    Route::get('get-user/{id}',function($id){
        $user = User::whereId($id)->with('roles')->first();
        // $user->removeRole($user->getRoleNames()[0]);
        dd($user->toArray());
        // $role = Role::create(['name' => 'admin']);
        // $user->assignRole($role);
    });
});