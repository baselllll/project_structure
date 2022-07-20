<?php


namespace Modules\UserModule\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
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
            Arr::only($data,
                ['first_name','last_name','gender','Id_Front','company_offer_letter','work_company','Id_Back','password','email','role_name','location','profile_type','phone_number']
            );

            // Arr::only($data,['ar_name','en_name','password','email','role_name']);
            $data['password'] = bcrypt(Arr::get($data,'password'));
            $role = $this->get_role_if_from_name(Arr::get($data,'role_name'));
            $user = $this->userRepository->create([
                'name' =>Arr::get($data, 'first_name').' '.Arr::get($data, 'last_name'),
                'email'=>$data['email'],
                'password'=>$data['password'],
                'location'=>$data['location'],
                'profile_type'=>$data['profile_type'],
                'phone_number'=>$data['phone_number'],
                'address'=>$data['address'],
                'work_company'=>$data['work_company'],
                'gender'=>$data['gender']
            ]);
            $user->assignRole($role);
            if (!is_null($file = Arr::get($data, 'image'))) {
                $user->addMedia($file)
                ->preservingOriginal()
                ->toMediaCollection('profile_image');
            }
            if (!is_null($Id_Front = Arr::get($data, 'Id_Front'))) {
                $user->addMedia($Id_Front)
                    ->preservingOriginal()
                    ->toMediaCollection('Id_Front');
            }
            if (!is_null($Id_Back = Arr::get($data, 'Id_Back'))) {
                $user->addMedia($Id_Back)
                    ->preservingOriginal()
                    ->toMediaCollection('Id_Back');
            }
            if (!is_null($company_offer_letter = Arr::get($data, 'company_offer_letter'))) {
                $user->addMedia($company_offer_letter)
                    ->preservingOriginal()
                    ->toMediaCollection('company_offer_letter');
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

    public function firstOrFailSocial(string $social_provider, string $token)
    {
        $social_user = Socialite::driver($social_provider)->stateless()->userFromToken($token);
        $email = $social_user->getEmail() ?? sprintf("%s@%s.com", $social_user->getId(), $social_provider);
        $user_by_social_mail = $this->userRepository->findByField('email', $email)->first();
        //the user has not registered by social before
        if (is_null($user_by_social_mail)) {
            return $this->userRepository->create([
                'name'=>$social_user->name,
                'email'=>$social_user->email,
                'password' => bcrypt('123456')
            ]);
        }else{
            return  response()->json(['message'=>"user exist before",'data'=> $user_by_social_mail]);
        }
    }
}
