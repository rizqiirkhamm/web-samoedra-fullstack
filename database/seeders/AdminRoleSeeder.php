<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = new RoleModel();
        $adminRole->name = 'Admin';
        $adminRole->save();

        $permissions = PermissionModel::all();

        $permissionsIds = $permissions->pluck('id')->toArray();
        PermissionRoleModel::InserUpdateRecord($permissionsIds, $adminRole->id);
    }
}
