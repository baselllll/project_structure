<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesNamesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('roles_names.role') as $item) {
            Role::create([
                "name"=>$item,
                "guard_name"=>"api",
            ]);
        }
    }
}
