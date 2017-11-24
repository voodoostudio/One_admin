<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $god_role = Role::where('name', 'god')->firstOrFail();

            User::create([
                'name'           => 'God',
                'email'          => 'god@god.com',
                'password'       => bcrypt('password'),
                'remember_token' => str_random(60),
                'role_id'        => $god_role->id,
            ]);

            $super_admin_role = Role::where('name', 'super_admin')->firstOrFail();

            User::create([
                'name'           => 'Super Admin',
                'email'          => 'sadmin@admin.com',
                'password'       => bcrypt('superadmin'),
                'remember_token' => str_random(60),
                'role_id'        => $super_admin_role->id,
            ]);
        }
    }
}
