<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\UserModule\Http\Requests\LoginRequest;
use Modules\UserModule\Http\Requests\RegisterUserRequest;
use Modules\UserModule\Services\AuthService;
use Modules\UserModule\Http\Resources\UserResource;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserLoginController extends Controller
{
    protected $userservice;
    public function __construct(AuthService $userservice) {
        $this->userservice = $userservice;
    }
    public function loginUser(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        //Request is validated
        //Create Token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
    	return $credentials;
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }
        $user = Auth::user();
 		//Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => new UserResource($user),
        ]);
    }
     public function registerUser(RegisterUserRequest $request)
     {
         $user = new UserResource($this->userservice->createuser($request->validated()));
         return response()->json($user,200);
    }
    public function GetAllUser(){
        $users = UserResource::collection($this->userservice->getallusers());
        return response()->json($users,200);
    }
}
