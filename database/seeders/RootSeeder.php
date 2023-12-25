<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class RootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();

        $root = Hash::make("root");

        $rootUser = User::create([
            'name' => 'root',
            'email' => 'root@gmail.com',
            'password' => $root,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $rootUser->assignRole('root');

        $permissionRoot = [
            'index-Permission',
            'create-Permission',
            'show-Permission',
            'store-Permission',
            'edit-Permission',
            'update-Permission',
            'destroy-Permission',
            'export-Permission',
            'import-Permission',
            'index-Role',
            'store-Role',
            'create-Role',
            'export-Role',
            'import-Role',
            'show-Role',
            'edit-Role',
            'update-Role',
            'destroy-Role',
            'addPermissionsAuto-Permission',
            'showRolePermission-Permission',
            'assignRolePermission-Permission',
            'getPermissionsAction-Permission',
            'userAssignedPermissions-Permission',
            'index-User',
            'create-User',
            'store-User',
            'show-User',
            'edit-User',
            'update-User',
            'destroy-User',
            'import-User',
            'export-User',
        ];

        $rootUser->givePermissionTo($permissionRoot);

    }
}
