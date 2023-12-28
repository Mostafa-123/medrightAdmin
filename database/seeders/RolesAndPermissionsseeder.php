<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsseeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $gardName = config('auth.defaults.guard');
        $permissionsByRole = [
            'admin' => [
                /*roles*/
                'roles.create',
                'roles.edit',
                'roles.destroy',
                'roles.index',
                'roles.export',
                'roles.import',
                'roles.show',
                /*permissions*/
                'permissions.create',
                'permissions.edit',
                'permissions.destroy',
                'permissions.index',
                'permissions.export',
                'permissions.import',
                'permissions.show',
                /*users*/
                'users.create',
                'users.edit',
                'users.destroy',
                'users.index',
                'users.export',
                'users.import',
                'users.show',
                /*pages*/
                'pages.create',
                'pages.edit',
                'pages.destroy',
                'pages.index',
                'pages.export',
                'pages.import',
                'pages.show',
                'pages.editor',

                /*forms*/
                'forms.create',
                'forms.edit',
                'forms.destroy',
                'forms.index',
                'forms.export',
                'forms.import',
                'forms.show',
                'forms.editor',

                /*levels*/
                'levels.create',
                'levels.edit',
                'levels.destroy',
                'levels.index',
                'levels.export',
                'levels.import',
                'levels.show',
                'levels.editor',
                /*positions*/
                'positions.create',
                'positions.edit',
                'positions.destroy',
                'positions.index',
                'positions.export',
                'positions.import',
                'positions.show',
                'positions.editor',
                /*requests*/
                'requests.destroy',
                'requests.index',
                'requests.show',
                'requests.export',
                'requests.import',

            ],
        ];


        $insertPermissions = fn ($role) => collect($permissionsByRole[$role])
            ->map(fn ($name) => DB::table(config('permission.table_names.permissions'))->insertGetId(['name' => $name, 'group' => ucfirst(explode('.', str_replace('_', ' ', $name))[0]), 'guard_name' => $gardName, 'created_at' => now(),]))
            ->toArray();

        $permissionIdsByRole = [
            'admin' => $insertPermissions('admin'),
        ];

        foreach ($permissionIdsByRole as $roleName => $permissionIds) {
            $role = Role::whereName($roleName)->first();
            if (!$role) {
                $role = Role::create([
                    'name' => $roleName,
                    'guard_name' => $gardName,
                    'created_at' => now(),
                ]);
            }
            DB::table(config('permission.table_names.role_has_permissions'))
                ->insert(
                    collect($permissionIds)->map(fn ($id) => [
                        'role_id' => $role->id,
                        'permission_id' => $id,
                    ])->toArray()
                );
            $user = User::where('name', $roleName)->first();
            if ($user) {
                $user->assignRole($role);
                $user->givePermissionTo(DB::table('permissions')->whereIn('id',$permissionIds)->pluck('name')->toArray());
            }
        }
    }
}
