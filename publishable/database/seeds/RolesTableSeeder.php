<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => 'god']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'God',
                ])->save();
        }

        $role = Role::firstOrNew(['name' => 'super_admin']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Super administrateur',
                ])->save();
        }

        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Administrateur',
                ])->save();
        }

        $role = Role::firstOrNew(['name' => 'moderator']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Modérateur',
                ])->save();
        }

        $role = Role::firstOrNew(['name' => 'client']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Client',
                ])->save();
        }

    }
}
