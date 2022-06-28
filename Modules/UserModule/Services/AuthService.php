<?php


namespace Modules\UserModule\Services;

use Exception;
use Illuminate\Support\Arr;
use Laravel\Socialite\Facades\Socialite;
use Modules\UserModule\Repositories\UserRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends BaseService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)

    {
        $this->userRepository = $userRepository;
        // $this->roleRepository = $roleRepository;
        // $this->phoneVerifier = $phoneVerifierManager->driver();
        // $this->otp = $OTP;
    }

    /**
     * @inheritDoc
     */
    function getRepository(): BaseRepository
    {
        return $this->userRepository;
    }
    public function get_role_if_from_name($role_name){
        return Role::whereName($role_name)->first();

    }
    public function createuser(array $data)
    {
        try {
            Arr::only($data,['name','password','email','role_name','location','profile_type','phone_number']);
            // Arr::only($data,['ar_name','en_name','password','email','role_name']);
            $data['password'] = bcrypt(Arr::get($data,'password'));
            $role = $this->get_role_if_from_name(Arr::get($data,'role_name'));
            $user = $this->userRepository->create([
                // 'name' =>[
                //     'ar' =>  Arr::get($data, 'ar_name'),
                //     'en' =>  Arr::get($data, 'en_name')
                // ],
                'name' =>Arr::get($data, 'name'),
                'email'=>$data['email'],
                'password'=>$data['password'],
                'location'=>$data['location'],
                'profile_type'=>$data['profile_type'],
                'phone_number'=>$data['phone_number'],
            ]);
            $user->assignRole($role);
            if (!is_null($file = Arr::get($data, 'image'))) {
                $user->addMedia($file)
                ->preservingOriginal()
                ->toMediaCollection('profile_image');
            }
           return $user;
        }
        catch(Exception $e){
           return $e->getMessage();
        }
    }
    public function getallusers(){
       return $this->userRepository->with('roles')->all();
    }

    public function resetPassword(string $phone_number, string $new_password)
    {
        $user = $this->userRepository->where('phone_number',$phone_number);
        $user_updated = $user->update(['password' => bcrypt($new_password)]);
        $user = $this->userRepository->find($user->first()->id);
        $credentials = ['email'=>$user->email,"password"=>$new_password];
         $token = JWTAuth::attempt($credentials);
        $user->token = $token;
        if (is_null($user)) {
            abort(404, "The User was not found");
        }
        return $user;
    }
    /**
     * Login Using A Social Provider
     * @param string $social_provider
     * @param string $token
     * @return \App\Models\User
     * @throws UserNotFoundException
     */
    public function firstOrFailSocial(string $social_provider, string $token)
    {
        $social_user = Socialite::driver($social_provider)->stateless()->userFromToken($token);
        $email = $social_user->getEmail() ?? sprintf("%s@%s.com", $social_user->getId(), $social_provider);
        $user_by_social_mail = $this->userRepository->findBy('email', $email);

        //the user has not registered by social before
        if (is_null($user_by_social_mail)) {
            abort(404,"Not Found");
        }

        return $user_by_social_mail;
    }
}
