<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRoleModel extends Model
{
    use HasFactory;

        protected $table = 'permission_roles';

      static public function InserUpdateRecord($permission_ids, $role_id){
            PermissionRoleModel::where('role_id', '=', $role_id)->delete();
        foreach($permission_ids as $permission_id ){
            $save = new PermissionRoleModel();
            $save->permission_id = $permission_id;
            $save->role_id = $role_id;
            $save->save();

        };

      }
      static public function getRolePermission($role_id){
        return PermissionRoleModel::where('role_id', '=', $role_id)->get();
      }

      static public function getPermission($role_id, $slug) {
        return PermissionRoleModel::select('permission_roles.id')
            ->join('permissions', 'permissions.id', '=', 'permission_roles.permission_id')
            ->where('permission_roles.role_id', '=', $role_id)
            ->where('permissions.slug', '=', $slug)
            ->count();
    }


}
