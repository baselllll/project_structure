<?php

namespace Modules\UserModule\Services;

use Prettus\Repository\Eloquent\BaseRepository;

abstract class BaseService
{
    /**
     * @return Repository
     */
    abstract function getRepository(): BaseRepository;

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    function getModel()
    {
        return $this->getRepository()->model();
    }
}
