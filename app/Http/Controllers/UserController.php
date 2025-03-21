<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RoleModel;

use Illuminate\Http\Request;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function list(){

        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'User');
        if(empty($PermissionRole)){
            abort(404);
        }

        $data['PermissionAdd'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Add User');
        $data['PermissionEdit'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit User');
        $data['PermissionDelete'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Delete User');


        $data['getRecord'] = User::getRecord();
        return view('users.user.dashboard', $data);

    }

    public function add(){
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Add User');
        if(empty($PermissionRole)){
            abort(404);
        }


        $data['getRole'] = RoleModel::getRecord();
        return view('users.user.add', $data);
    }

    function edit($id){

        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit User');
        if(empty($PermissionRole)){
            abort(404);
        }

        $data['getRecord'] = User::getSingle($id);
        $data['getRole'] = RoleModel::getRecord();
        return view('users.user.edit', $data);
    }

    public function insert(Request $request){

        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Add User');
        if(empty($PermissionRole)){
            abort(404);
        }

        request()->validate([
            'email' => 'required|email|unique:Users',
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = trim($request->password);
        $user->role_id = trim($request->role_id);
        $user->save();

        return redirect('/user')->with('succes', "User successfully created");
    }

    public function update($id, Request $request){

        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit User');
        if(empty($PermissionRole)){
            abort(404);
        }

        $user = User::getSingle($id);
        $user->name = trim($request->name);
       if(!empty($request->password)){
        $user->password = trim($request->password);
       }
        $user->role_id = trim($request->role_id);
        $user->save();

        return redirect('/user')->with('succes', "User successfully created");
    }

    public function delete($id){

        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Delete User');
        if(empty($PermissionRole)){
            abort(404);
        }

        $user = User::getSingle($id);
        $user->delete();

        return redirect('/user')->with('success', "User successfully deleted");
    }




}
