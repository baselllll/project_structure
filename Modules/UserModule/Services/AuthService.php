<?php


namespace Modules\UserModule\Services;

use Exception;
use Illuminate\Support\Arr;
use Modules\UserModule\Repositories\UserRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Spatie\Permission\Models\Role;

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
            Arr::only($data,['ar_name','en_name','password','email','role_name']);
            $data['password'] = bcrypt(Arr::get($data,'password'));
            $role = $this->get_role_if_from_name(Arr::get($data,'role_name'));
            $user = $this->userRepository->create([
                'name' =>[
                    'ar' =>  Arr::get($data, 'ar_name'),
                    'en' =>  Arr::get($data, 'en_name')
                ],
                'email'=>$data['email'],
                'password'=>$data['password']
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
}
