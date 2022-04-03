<?php

namespace App\Traits\Testing;

use App\Models\Collector;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Models\Workshop;

trait GeneratesUsers
{
    /**
     * @param int $count
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function generateWorkshops($count = 10)
    {
        //create company owner with company and 1 workshop
        return User::factory()->count($count)
            ->role_type(Role::WORKSHOP)
            ->create()
            ->each(function (User $user) {
                $owner = User::factory()->role_type(Role::COMPANY)->create();
                $company = Company::factory()->create();
                $owner->typeable()->save($company);
                $workshop = Workshop::factory()->create(['company_id' => $company->id]);

                $user->update([
                    "typeable_id" => $workshop->id,
                    "typeable_type" => Workshop::class,
                ]);
            });
    }

    public function generateCompanyOwners($count = 10, $company_workshop_count = 1)
    {
        return User::factory()->count($count)
            ->role_type(Role::COMPANY)
            ->create()
            ->each(function (User $user) use ($company_workshop_count) {
                $company = Company::factory()
                    ->create();

                Workshop::factory()
                    ->count($company_workshop_count)
                    ->create(['name' => $company->name])->each(function (Workshop $workshop) {
                        $owner = User::factory()->role_type(Role::WORKSHOP)->create();
                        $owner->update([
                            "typeable_id" => $workshop->id,
                            "typeable_type" => Workshop::class,
                        ]);
                    });

                $user->update([
                    "typeable_type" => Company::class,
                    "typeable_id" => $company->id,
                ]);
            });
    }

    /**
     * @param int $count
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function generateUser($count = 10)
    {
        //create company owner with company and 1 workshop
        return User::factory()->count($count)
            ->role_type(Role::USER)
            ->create();
    }

    /**
     * @param $count
     * @return mixed
     */
    public function generateCollector($count = 10)
    {
        return User::factory()->count($count)
            ->role_type(Role::COLLECTOR)
            ->create()
            ->each(function (User $user) {
                $item = Collector::factory()->create();
                $user->update([
                    "typeable_type" => Collector::class,
                    "typeable_id" => $item->id,
                ]);
            });
    }

    /**
     * @param int $count
     * @return mixed
     */
    public function generateAdmin(int $count = 10)
    {
        return User::factory()->count($count)
            ->role_type(Role::ADMINISTRATOR)
            ->create();
    }
}
