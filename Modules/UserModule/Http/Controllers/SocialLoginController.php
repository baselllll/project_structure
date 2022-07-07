<?php

namespace Modules\UserModule\Http\Controllers;

use App\Models\SocialProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Modules\UserModule\Http\Requests\SocialLoginRequest;
use Modules\UserModule\Services\AuthService;

class SocialLoginController
{
    protected  $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService=$authService;
    }

    public function redirectToProvider(Request $request, $provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback(SocialLoginRequest $request, $provider)
    {

//            if ($provider == SocialProvider::APPLE) {
//                config()->set('services.apple.client_secret', resolve(AppleToken::class)->generate());
//            }
            $user = $this->authService->firstOrFailSocial($provider, $request->get('token'));

            $token = $user->access_token;

            return response()->json([
                "user" => new \Modules\UserModule\Http\Resources\UserResource($user),
                "token" => $token
            ]);

    }
}
