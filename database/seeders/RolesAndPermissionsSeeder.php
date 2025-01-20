<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'create products',
            'edit products',
            'delete products',
            'view products',
            // Add more permissions as needed
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign existing permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        $editorRole = Role::firstOrCreate(['name' => 'manager']);
        $editorRole->syncPermissions([
            'create products',
            'edit products',
            'view products',
        ]);

        $viewerRole = Role::firstOrCreate(['name' => 'salesman']);
        $viewerRole->syncPermissions([
            'view products',
        ]);

        // Assign roles to users
        $adminUser = \App\Models\User::where('email', 'admin@example.com')->first();
        if ($adminUser) {
            $adminUser->assignRole($adminRole);
        }

        // Repeat for other users as necessary
    }
}
