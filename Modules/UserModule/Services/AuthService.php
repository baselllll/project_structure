<?php


namespace Modules\UserModule\Services;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            Arr::only($data,['name','password','email','role_name']);
            $data['password'] = bcrypt(Arr::get($data,'password'));
            $role = $this->get_role_if_from_name(Arr::get($data,'role_name'));
            $user = $this->userRepository->create($data);
            $user->assignRole($role);
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
