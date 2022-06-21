<?php

namespace Modules\UserModule\Repositories;

use App\Models\User;
use App\Models\Vechiles;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;


class VechileRepository extends BaseRepository
{
    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    /**
     * @return string
     */
    public function model()
    {
        return Vechiles::class;
    }
}
