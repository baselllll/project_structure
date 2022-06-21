<?php


namespace Modules\UserModule\Services;

use Exception;
use Illuminate\Support\Arr;
use Modules\UserModule\Repositories\VechileRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Spatie\Permission\Models\Role;

class VechileService extends BaseService
{
    protected $vechileRepository;
    public function __construct(VechileRepository $vechileRepository)

    {
        $this->vechileRepository = $vechileRepository;
    }

    /**
     * @inheritDoc
     */
    function getRepository(): BaseRepository
    {
        return $this->vechileRepository;
    }
    public function get_role_if_from_name($role_name){
        return Role::whereName($role_name)->first();

    }
    public function createVechile(array $data)
    {
            Arr::only($data,['model','type','number','color','YearOfReg','notes','image']);
            $vechile = $this->vechileRepository->create([
                'model' =>Arr::get($data, 'model'),
                'type'=>$data['type'],
                'number'=>$data['number'],
                'color'=>$data['color'],
                'YearOfReg'=>$data['YearOfReg'],
                'notes'=>$data['notes']
            ]);
             if (!is_null($file = Arr::get($data, 'image'))) {
                $vechile->addMedia($file)
                ->preservingOriginal()
                ->toMediaCollection('profile_image');
            }
            $vechile = $this->vechileRepository->find($vechile->id);
           return $vechile;

    }
    public function getallvechiles($page_size=10){
        return $this->vechileRepository->paginate($page_size);
     }
}
