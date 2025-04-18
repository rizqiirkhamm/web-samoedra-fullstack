<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    use HasFactory;

        protected $table = 'permissions';

    protected $fillable = [
        'name',
        'slug',
        'groupby'
    ];

        static public function getSingle($id){
            return RoleModel::find($id);
        }

        static public function getRecord(){
            $getPermission = PermissionModel::select('groupby')
                ->distinct()
                ->get();

            $result = array();
            foreach ($getPermission as $value){
                $getPermissionGroup = PermissionModel::getPermissionGroup($value->groupby);
                $data = array();
                $data['name'] = $value->groupby;
                $group = array();
                foreach($getPermissionGroup as $valueG){
                    $dataG = array();
                    $dataG['id'] = $valueG->id;
                    $dataG['name'] = $valueG->name;
                    $group[] = $dataG;
                }
                $data['group'] = $group;
                $result[] = $data;
            }
            return $result;
        }

        static public function getPermissionGroup($groupby){
           return PermissionModel::where('groupby', '=', $groupby)->get();
        }
}
