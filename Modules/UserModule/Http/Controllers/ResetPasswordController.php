<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\UserModule\Http\Requests\ResetPasswordRequest;
use Modules\UserModule\Http\Resources\UserResource;
use Modules\UserModule\Services\AuthService;
use Exception;

class ResetPasswordController extends Controller
{
    protected  $authservice ;
    public function __construct(AuthService $authService)
    {
        $this->authservice = $authService;
    }

    public function resetPassword(ResetPasswordRequest $request)
    {

            $user = $this->authservice->resetPassword(
                $request->get('phone_number'),
                $request->get('password'),
            );

            $token = $user->token;
            return response()->json([
                "message"=>"data stored successfully",
                "status"=>"success",
                "data" => new UserResource($user),
                "token" => $token
            ],200);
   }
}
