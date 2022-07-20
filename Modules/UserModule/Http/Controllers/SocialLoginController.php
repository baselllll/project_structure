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
        $user = Socialite::driver($provider)->stateless()->user();

//        dd(\request()->all());

//            if ($provider == SocialProvider::APPLE) {
//                config()->set('services.apple.client_secret', resolve(AppleToken::class)->generate());
//            }
        $user_token = $user->token;
        $user = $this->authService->firstOrFailSocial($provider, $user->token);

            return response()->json([
                "user" => $user,
                "token" => $user_token
            ]);

    }
}
