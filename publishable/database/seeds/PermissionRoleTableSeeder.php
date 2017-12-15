<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        /*-- GOD --*/

        $role_god = Role::where('name', 'god')->firstOrFail();

        $god_permissions = Permission::all();

        $role_god->permissions()->sync(
            $god_permissions->pluck('id')->all()
        );

        /*-- SUPER ADMIN --*/

        $role_super_admin = Role::where('name', 'super_admin')->firstOrFail();

        $super_admin_permissions = Permission::whereIn('id',[1,21,22,23,24,25,26,27,28,29,30])->get();

        $role_super_admin->permissions()->sync(
            $super_admin_permissions->pluck('id')->all()
        );

        /*-- ADMIN --*/

        $role_admin = Role::where('name', 'admin')->firstOrFail();

        $admin_permissions = Permission::whereIn('id',[1,21,22,23,24,25,26,27,28,29,30])->get();

        $role_admin->permissions()->sync(
            $admin_permissions->pluck('id')->all()
        );

        /*-- MODERATOR --*/

        $role_moderator = Role::where('name', 'moderator')->firstOrFail();

        $moderator_permissions = Permission::whereIn('id',[1,21,22,23,24,25,26,27,28,29,30])->get();

        $role_moderator->permissions()->sync(
            $moderator_permissions->pluck('id')->all()
        );

        /*-- USER  --*/

        $role_user = Role::where('name', 'user')->firstOrFail();

        $user_permissions = Permission::whereIn('id',[1,26,27])->get();

        $role_user->permissions()->sync(
            $user_permissions->pluck('id')->all()
        );
    }
}
