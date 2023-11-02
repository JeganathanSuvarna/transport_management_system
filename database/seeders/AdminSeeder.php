<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash ;
use Illuminate\Support\Str;

class AdminSeeder extends DatabaseSeeder
{

    public function run()
    {
        $user = User::create([
            'first_name'  => 'Super',
            'last_name'=>'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),

        ]);

        $user->assignRole('SuperAdmin');
        $permissions = [
           
            [
                'module' => 'Roles',

                'permissions' => [
                    'Add-Role',
                    'View-Role',
                    'Edit-Role',
                    'Assign-Permissions'


                ],
            ],
            [
                'module' => 'Add New-bus',

                'permissions' => [
                    'Create-busdata2',

                ],
            ],
            [
                'module' => 'Bus Info',

                'permissions' => [
                    'Create-busdata',
                    'View-busdata',
                    'Edit-busdata',
                    'Delete-busdata'
                ],
            ],
            [
                'module' => 'Add New-route',

                'permissions' => [
                    'Create-route',

                ],
            ],
            [
                'module' => 'Route Info',

                'permissions' => [
                    'Create-routedata',
                    'View-routedata',
                    'Edit-routedata',
                    'Delete-routedata'
                ],
            ],
            [
                'module' => 'Add New-schedule',

                'permissions' => [
                    'Create-schedule',

                ],
            ],
            [
                'module' => 'Schedules Info',

                'permissions' => [
                    'Create-scheduledata',
                    'View-scheduledata',
                    'Edit-scheduledata',
                    'Delete-scheduledata'
                ],
            ],
            [
                'module' => 'Users',

                'permissions' => [
                    'Create-user',
                    'View-user',
                    'Edit-user',
                    'Delete-user'
                ],
            ],
                   //venue
                   [
                    'module' => 'Reports',
    
                    'permissions' => [
                        'View-reports',
                        'Download-reports'
    
                    ],
                ],
              
            

        ];
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['module'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $user->givePermissionTo($permission);
                // $permission->assignRole($role);
            }
        }
    }
}
