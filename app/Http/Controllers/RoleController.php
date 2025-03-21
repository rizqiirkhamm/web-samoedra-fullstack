<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use Illuminate\Http\Request;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    public function list(){

        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Role');
        if(empty($PermissionRole)){
            abort(404);
        }

        $data['PermissionAdd'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Add Role');
        $data['PermissionEdit'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Role');
        $data['PermissionDelete'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Delete Role');


        $data['getRecord'] = RoleModel::getRecord();
        return view('users.role.dashboard', $data);
    }

    public function add(){

        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Add Role');
        if(empty($PermissionRole)){
            abort(404);
        }

        $getPermission = PermissionModel::getRecord();
        $data['getPermission'] = $getPermission;
        return view('users.role.add', $data);
    }

    public function Insert(Request $request){

        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Add Role');
        if(empty($PermissionRole)){
            abort(404);
        }

       $save = new RoleModel();
       $save->name = $request->name;
       $save->save();

        PermissionRoleModel::InserUpdateRecord($request->permission_id, $save->id);

       return redirect('/role')->with('success', "Role successfully created");
    }

    public function edit($id){

        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Role');
        if(empty($PermissionRole)){
            abort(404);
        }

        $data['getRecord'] = RoleModel::getSingle($id);
        $data['getPermission'] = PermissionModel::getRecord();
        $data['getRolePermission'] =PermissionRoleModel::getRolePermission($id);
        return view('users.role.edit', $data);
    }

    public function update($id, Request $request){

        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Role');
        if(empty($PermissionRole)){
            abort(404);
        }

        $save = RoleModel::getSingle($id);
        $save->name = $request->name;
        $save->save();

        PermissionRoleModel::InserUpdateRecord($request->permission_id, $save->id);


        return redirect('/role')->with('success', "Role successfully Updated");
     }

     public function delete($id){

        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Delete Role');
        if(empty($PermissionRole)){
            abort(404);
        }

        $save = RoleModel::getSingle($id);
        $save->delete();

        return redirect('/role')->with('success', "Role successfully Deleted");
     }
}
