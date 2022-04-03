<?php


namespace Modules\UserModule\Services;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\UserModule\Repositories\UserRepository;
use Prettus\Repository\Eloquent\BaseRepository;


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

    public function createuser(array $data)
    {
        try {
            Arr::only($data,['name','password','email']);
            $data['password'] = bcrypt(Arr::get($data,'password'));
            return $this->userRepository->create($data);
        }
        catch(Exception $e){
           return $e->getMessage();
        }
    }
    public function getallusers(){
       return $this->userRepository->all();
    }
}
